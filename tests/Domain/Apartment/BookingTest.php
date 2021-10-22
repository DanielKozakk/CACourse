<?php

namespace Domain\Apartment;

use DateTime;
use Helpers\PropertiesUnwrapper;
use Infrastructure\EventChannel\Symfony\SymfonyEventDispatcher;
use PHPUnit\Framework\TestCase;
use ReflectionException;

require_once ('BookingAssertion.php');

class BookingTest extends TestCase
{

    use PropertiesUnwrapper;
    /**
     * @throws ReflectionException
     */
    public function testShouldCreateBookingApartmentWithAllRequiredFields (){

        $rentalPlaceId = '9634';
        $tenantId = '12511';

        $periodStart=  DateTime::createFromFormat('d-m-Y', '09-05-1995');
        $periodEnd=  DateTime::createFromFormat('d-m-Y', '09-05-1995');
        $period = new Period($periodStart, $periodEnd);

        $actual = Booking::bookApartment($rentalPlaceId, $tenantId, $period);

        $expectedDays = [DateTime::createFromFormat('d-m-Y', '09-05-1995')];

        BookingAssertion::assert($actual)
            ->isOpen()
            ->hasRentalTypeEqualsTo(RentalType::APARTMENT)
            ->hasRentalPlaceIdEqualsTo($rentalPlaceId)
            ->hasTenantIdEqualsTo($tenantId)
            ->hasDaysEqualsTo($expectedDays);

    }

    /**
     * @throws ReflectionException
     */
    public function testShouldCreateBookingHotelRoomWithAllRequiredFields (){

        $rentalPlaceId = '5122';
        $tenantId = '4734';

        $expectedDays = [
            DateTime::createFromFormat('d-m-Y', '09-05-1995'),
            DateTime::createFromFormat('d-m-Y', '10-05-1995'),
            DateTime::createFromFormat('d-m-Y', '11-05-1995'),
            DateTime::createFromFormat('d-m-Y', '12-05-1995'),
        ];

        $actual = Booking::bookHotelRoom($rentalPlaceId, $tenantId, $expectedDays);


        BookingAssertion::assert($actual)
            ->isOpen()
            ->hasRentalTypeEqualsTo(RentalType::HOTEL_ROOM)
            ->hasRentalPlaceIdEqualsTo($rentalPlaceId)
            ->hasTenantIdEqualsTo($tenantId)
            ->hasDaysEqualsTo($expectedDays);

    }

    /**
     * @throws ReflectionException
     */
    public function testShouldChangeBookingStatusIntoReject(){
        $booking = Booking::bookHotelRoom('123', '456', [new DateTime()]);
        $booking->reject();

        $bookingStatus = $this->getReflectionValue(Booking::class, 'bookingStatus',$booking);
        $bookingStatusState = $this->getReflectionValue(BookingStatus::class, 'state', $bookingStatus);

        $this->assertEquals('REJECTED', $bookingStatusState);
    }

    /**
     * @throws ReflectionException
     */
    public function testShouldChangeBookingStatusIntoAccept(){
        $rentalSpaceId = '1';
        $tenantId = '2';
        $days = [new DateTime('2024-01-01'), new DateTime('2024-01-02')];

        $booking = Booking::bookHotelRoom($rentalSpaceId, $tenantId,$days);

        $eventChannel = $this->createMock(SymfonyEventDispatcher::class);

        $eventChannel->expects($this->once())->method('publishBookingAcceptedEvent')->with(
            $this->callback(function(BookingAcceptedEvent $bookingAcceptedEvent) use ($days, $tenantId, $rentalSpaceId) {

                $this->assertEquals(RentalType::hotelRoomRentalType()->getState(), $bookingAcceptedEvent->getRentalType());
                $this->assertEquals($rentalSpaceId, $bookingAcceptedEvent->getRentalPlaceId());
                $this->assertEquals($tenantId, $bookingAcceptedEvent->getTenantId());
                $this->assertEqualsCanonicalizing($days, $bookingAcceptedEvent->getDays());
                return true;
            })
        );

        $booking->accept($eventChannel);

        /**
         * @var BookingStatus $actualBookingStatus
         */
        $actualBookingStatus = $this->getReflectionValue(Booking::class, 'bookingStatus', $booking);
        $this->assertEquals(BookingStatus::$ACCEPTED, $actualBookingStatus->getState());
    }

}
