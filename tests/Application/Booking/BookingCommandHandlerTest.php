<?php

namespace Application\Booking;

use Cassandra\Date;
use DateTime;
use Domain\Apartment\Booking;
use Domain\Apartment\BookingAssertion;
use Domain\Apartment\BookingRepository;
use Domain\Apartment\RentalType;
use Domain\EventChannel\EventChannel;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookingCommandHandlerTest extends WebTestCase
{
    private const RENTAL_SPACE_ID = '1';
    private const TENANT_ID = '1231';
    private DateTime $startDate;
    private DateTime $endDate;

    private BookingRepository $bookingRepository;
    private EventChannel $eventChannel;

    private BookingCommandHandler $bookingCommandHandler;

    public function __construct()
    {
        parent::__construct();
        self::bootKernel();

        $this->startDate = new DateTime('2021-02-02');
        $this->endDate = new DateTime('2021-03-02');

        $this->bookingRepository = $this->createMock(BookingRepository::class);
        $this->eventChannel = $this->createMock(EventChannel::class);
        $this->bookingCommandHandler = new BookingCommandHandler($this->bookingRepository, $this->eventChannel);
    }

    public function testShouldHandleRejectCommand(){

        $this->assertTrue(true);
        $this->givenBookingHotelRoom();

        $this->bookingRepository->expects($this->once())->method('save')->with($this->callback(
            function (Booking $booking){
                BookingAssertion::assert($booking)
                    ->isRejected()
                    ->hasDaysEqualsTo([$this->startDate, $this->endDate])
                    ->hasTenantIdEqualsTo(self::TENANT_ID)
                    ->hasRentalPlaceIdEqualsTo(self::RENTAL_SPACE_ID)
                    ->hasRentalTypeEqualsTo(RentalType::hotelRoomRentalType()->getState());
                return true;
            }
        ));

        $this->bookingCommandHandler->onBookingRejectCommand(new RejectBookingCommand('dummyValue'));
    }

    private function givenBookingHotelRoom(){
        $booking = Booking::bookHotelRoom(self::RENTAL_SPACE_ID, self::TENANT_ID, [$this->startDate, $this->endDate]);
        $this->bookingRepository->method('findById')->willReturn($booking);
    }
}
