<?php

namespace Domain\Apartment;

use DateTime;
use Helpers\PropertiesUnwrapper;
use Infrastructure\EventChannel\Symfony\SymfonyEventDispatcher;
use PHPUnit\Framework\TestCase;
use ReflectionException;

require_once('BookingAssertion.php');

class BookingTest extends TestCase
{

    private const RENTAL_PLACE_ID = '1234';
    private const TENANT_ID = '9876';
    private DateTime $expectedStartDate;
    private DateTime $expectedEndDate;

    /**
     * @var array<DateTime>
     */
    private array $expectedDays;

    public function __construct()
    {
        parent::__construct();
        $this->expectedStartDate = DateTime::createFromFormat('d-m-Y', '09-05-1995');
        $this->expectedEndDate = DateTime::createFromFormat('d-m-Y', '10-05-1995');
        $this->expectedDays = [$this->expectedStartDate, $this->expectedEndDate];
    }


    use PropertiesUnwrapper;

    /**
     * @throws ReflectionException
     */
    public function testShouldCreateBookingApartmentWithAllRequiredFields()
    {

        $actual = $this->givenBookingWithRentalType(RentalType::APARTMENT);

        BookingAssertion::assert($actual)
            ->isOpen()
            ->hasRentalTypeEqualsTo(RentalType::APARTMENT)
            ->hasRentalPlaceIdEqualsTo(self::RENTAL_PLACE_ID)
            ->hasTenantIdEqualsTo(self::TENANT_ID)
            ->hasDaysEqualsTo($this->expectedDays);

    }

    /**
     * @throws ReflectionException
     */
    public function testShouldCreateBookingHotelRoomWithAllRequiredFields()
    {
        $actual = $this->givenBookingWithRentalType(RentalType::HOTEL_ROOM);

        BookingAssertion::assert($actual)
            ->isOpen()
            ->hasRentalTypeEqualsTo(RentalType::HOTEL_ROOM)
            ->hasRentalPlaceIdEqualsTo(self::RENTAL_PLACE_ID)
            ->hasTenantIdEqualsTo(self::TENANT_ID)
            ->hasDaysEqualsTo($this->expectedDays);
    }

    /**
     * @throws ReflectionException
     */
    public function testShouldChangeBookingStatusIntoReject()
    {
        $booking = $this->givenBookingWithRentalType(RentalType::APARTMENT);
        $booking->reject();

        BookingAssertion::assert($booking)->isRejected();
    }

    /**
     * @throws ReflectionException
     */
    public function testShouldChangeBookingStatusIntoAccept()
    {

        $booking = $this->givenBookingWithRentalType(RentalType::HOTEL_ROOM);

        $eventChannel = $this->createStub(SymfonyEventDispatcher::class);
        $booking->accept($eventChannel);

        BookingAssertion::assert($booking)->isAccepted();
    }

    public function testShouldPublishBookingAcceptedEventOnceAccepted()
    {
        $booking = $this->givenBookingWithRentalType(RentalType::HOTEL_ROOM);

        $eventChannel = $this->createMock(SymfonyEventDispatcher::class);

        $expectedDays = $this->expectedDays;
        $tenantId = self::TENANT_ID;
        $rentalSpaceId = self::RENTAL_PLACE_ID;

        $eventChannel->expects($this->once())->method('publishBookingAcceptedEvent')->with(
            $this->callback(function (BookingAcceptedEvent $bookingAcceptedEvent) use ($expectedDays, $tenantId, $rentalSpaceId) {

                $this->assertEquals(RentalType::hotelRoomRentalType()->getState(), $bookingAcceptedEvent->getRentalType());
                $this->assertEquals($rentalSpaceId, $bookingAcceptedEvent->getRentalPlaceId());
                $this->assertEquals($tenantId, $bookingAcceptedEvent->getTenantId());
                $this->assertEqualsCanonicalizing($expectedDays, $bookingAcceptedEvent->getDays());
                return true;
            })
        );
        $booking->accept($eventChannel);
    }

    private function givenBookingWithRentalType(string $rentalType): ?Booking
    {
        if ($rentalType === RentalType::APARTMENT) {
            return Booking::bookApartment(self::RENTAL_PLACE_ID, self::TENANT_ID, new Period($this->expectedStartDate, $this->expectedEndDate));
        }
        if ($rentalType === RentalType::HOTEL_ROOM) {
            return Booking::bookHotelRoom(self::RENTAL_PLACE_ID, self::TENANT_ID, $this->expectedDays);
        }
        return null;
    }
}
