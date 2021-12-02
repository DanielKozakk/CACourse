<?php

namespace Application\Booking;

use Application\CommandChannel\CommandChannel;
use DateTime;
use Domain\Apartment\Booking;
use Domain\Apartment\BookingRepository;
use Domain\Apartment\BookingStatus;
use Domain\EventChannel\EventChannel;
use Domain\Hotel\Hotel;
use Domain\Hotel\HotelFactory;
use Domain\Hotel\HotelRoom\HotelRoom;
use Domain\Hotel\HotelRoom\HotelRoomFactory;
use Helpers\PropertiesUnwrapper;
use Infrastructure\Persistence\Doctrine\Booking\DoctrineBookingRepository;
use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use Infrastructure\Rest\Api\Booking\BookingRestController;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookingCommandHandlerIntegrationTest extends WebTestCase
{

use PropertiesUnwrapper;
    private CommandChannel $commandChannel;

    private BookingRestController $bookingRestController;

    private DoctrineHotelRepository $doctrineHotelRepository;

    private EventChannel $eventChannel;

    private DoctrineBookingRepository $bookingRepository;

    private HotelRoom $hotelRoom;

    const TENANT_ID = 215121;
    /**
     * @var array<DateTime>
     */
    private array $days;

    private DateTime $startDate;
    private DateTime $endDate;

    /**
     * @throws ReflectionException
     */
    public function __construct()
    {
        parent::__construct();
        self::bootKernel();
        $container = $this->getContainer();

        $this->commandChannel = $container->get(CommandChannel::class);
        $this->bookingRestController = new BookingRestController($this->commandChannel );
        $this->doctrineHotelRepository = $container->get(DoctrineHotelRepository::class);
        $this->eventChannel = $container->get(EventChannel::class);
        $this->bookingRepository = $container->get(BookingRepository::class);

        $this->startDate = new DateTime('2021-02-02');
        $this->endDate = new DateTime('2021-02-03');
        $this->days = [$this->startDate, $this->endDate];
        $this->hotelRoom = $this->givenHotelRoom();
    }


    /**
     * @throws ReflectionException
     */
    public function testShouldRejectBooking(){
        $booking = $this->givenBooking();
        $bookingId = $this->getReflectionValue(Booking::class, 'id', $booking);
        $this->bookingRestController->reject($bookingId);

        $this->bookingRepository->refreshEntity($booking);
        /** @var BookingStatus $fetchedBookingStatus */
        $fetchedBookingStatus = $this->getReflectionValue(Booking::class, 'bookingStatus', $booking);
        $this->assertEquals(BookingStatus::$REJECTED, $fetchedBookingStatus->getState());

    }

    /**
     * @throws ReflectionException
     */
    public function testShouldAcceptBooking(){
        $booking = $this->givenBooking();
        $bookingId = $this->getReflectionValue(Booking::class, 'id', $booking);
        $this->bookingRestController->accept($bookingId);

        $this->bookingRepository->refreshEntity($booking);
        $fetchedBookingStatus = $this->getReflectionValue(Booking::class, 'bookingStatus', $booking);
        $this->assertEquals(BookingStatus::$ACCEPTED, $fetchedBookingStatus->getState());

    }


    private function givenBooking(): Booking
    {
        $hotelRoom = $this->hotelRoom;
        $booking = $hotelRoom->book(self::TENANT_ID, $this->days, $this->eventChannel);
        $this->bookingRepository->save($booking);

        return $booking;
    }

    /**
     * @throws ReflectionException
     */
    private function givenHotelRoom() : HotelRoom{
        $hotelRoomFactory = new HotelRoomFactory($this->doctrineHotelRepository);
        $hotelId=  $this->getReflectionValue(Hotel::class, 'id', $this->givenHotel());
        $hotelRoom = $hotelRoomFactory->create($hotelId, 90909090, ['dummyRoom' => 0.1], 'Dummy Description');

        $this->doctrineHotelRepository->saveHotelRoom($hotelRoom);
        return $hotelRoom;
    }
    private function givenHotel(): Hotel{
        $dummyValue = 'dummyValue';
        $hotelFactory = new HotelFactory();
        $hotel = $hotelFactory->create($dummyValue,$dummyValue,$dummyValue,$dummyValue,$dummyValue,$dummyValue);
        $this->doctrineHotelRepository->saveHotel($hotel);
        return $hotel;
    }
}
