<?php

namespace Application\Hotel\HotelRoom;

use DateTime;
use Domain\Apartment\Booking;
use Domain\Apartment\BookingAssertion;
use Domain\Apartment\BookingRepository;
use Domain\Apartment\RentalType;
use Domain\EventChannel\EventChannel;
use Domain\Hotel\HotelRoom\HotelRoom;
use Domain\Hotel\HotelRoom\HotelRoomRepository;
use Helpers\PropertiesUnwrapper;
use Infrastructure\EventChannel\Symfony\SymfonyEventDispatcher;
use Infrastructure\Persistence\Doctrine\Booking\DoctrineBookingRepository;
use Infrastructure\Persistence\Doctrine\Hotel\HotelRoom\DoctrineHotelRoomRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HotelRoomApplicationServiceTest extends WebTestCase
{
use PropertiesUnwrapper;
    private const TEST_HOTEL_ROOM_ID = 1;
    private const TENANT_ID = '21547';

    /**
     * @var array<DateTime>
     */
    private array $expectedDays;

    private HotelRoomRepository $hotelRoomRepository;
    private EventChannel $eventChannel;
    private BookingRepository $bookingRepository;
    private HotelRoomApplicationService $hotelRoomApplicationService;

    public function __construct()
    {
        parent::__construct();
        self::bootKernel();

        $this->expectedDays = [new DateTime('2021-01-01'), new DateTime('2021-01-02')];

        $this->hotelRoomRepository = $this->getContainer()->get(DoctrineHotelRoomRepository::class);
        $this->eventChannel = $this->createStub(SymfonyEventDispatcher::class);
        $this->bookingRepository = $this->createMock(DoctrineBookingRepository::class);
        $this->hotelRoomApplicationService = new HotelRoomApplicationService($this->hotelRoomRepository, $this->eventChannel, $this->bookingRepository);

    }


    public function testShouldCreateBookingWithAllParameters(){
        $this->bookingRepository->expects($this->once())->method('save')->with(
            $this->callback(
                function (Booking $booking){
                    BookingAssertion::assert($booking)
                        ->isOpen()
                        ->hasRentalTypeEqualsTo(RentalType::hotelRoomRentalType()->getState())
                        ->hasRentalPlaceIdEqualsTo(self::TEST_HOTEL_ROOM_ID)
                        ->hasTenantIdEqualsTo(self::TENANT_ID)
                        ->hasDaysEqualsTo($this->expectedDays);
                    return true;
                }
            ));

        $this->hotelRoomApplicationService->bookHotelRoom(self::TEST_HOTEL_ROOM_ID, self::TENANT_ID, $this->expectedDays);
    }
}
