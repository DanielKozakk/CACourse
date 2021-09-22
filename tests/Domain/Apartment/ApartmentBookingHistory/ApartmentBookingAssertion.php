<?php

namespace Domain\Apartment\ApartmentBookingHistory;

use DateTime;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

class ApartmentBookingAssertion extends Assert
{

    private ApartmentBooking $actual;

    /**
     * @param ApartmentBooking $actual
     */
    private function __construct(ApartmentBooking $actual)
    {
        $this->actual = $actual;
    }


    public static function assert(ApartmentBooking $actual): ApartmentBookingAssertion
    {
        return new ApartmentBookingAssertion($actual);
    }

    public function hasBookingDateTimeEqualTo(DateTime $bookingCreationDateTime) :ApartmentBookingAssertion
    {

        $reflectionProperty = new ReflectionProperty(ApartmentBooking::class, 'bookingCreation');
        $reflectionProperty->setAccessible(true);

        $actualBookingCreationDateTime = $reflectionProperty->getValue($this->actual);
        $this->assertEquals($actualBookingCreationDateTime, $bookingCreationDateTime);
        return $this;
    }

    public function hasOwnerIdEqualTo(string $ownerId): ApartmentBookingAssertion
    {
        $reflectionProperty = new ReflectionProperty(ApartmentBooking::class, 'ownerId');
        $reflectionProperty->setAccessible(true);

        $actualOwnerId = $reflectionProperty->getValue($this->actual);
        $this->assertEquals($actualOwnerId, $ownerId);

        return $this;

    }

    public function hasTenantIdEqualTo(string $tenantId): ApartmentBookingAssertion
    {
        $reflectionProperty = new ReflectionProperty(ApartmentBooking::class, 'tenantId');
        $reflectionProperty->setAccessible(true);

        $actualTenantId = $reflectionProperty->getValue($this->actual);
        $this->assertEquals($actualTenantId, $tenantId);

        return $this;
    }

    public function hasBookingPeriodThatHas(DateTime $startDate, DateTime $endDate): ApartmentBookingAssertion
    {
        $reflectionBookingPeriodProperty = new ReflectionProperty(ApartmentBooking::class, 'bookingPeriod');
        $reflectionBookingPeriodProperty->setAccessible(true);

        $bookingPeriodValue = $reflectionBookingPeriodProperty->getValue($this->actual);

        $reflectionStartDateProperty = new ReflectionProperty(BookingPeriod::class, 'startDate');
        $reflectionStartDateProperty->setAccessible(true);
        $reflectionEndDateProperty = new ReflectionProperty(BookingPeriod::class, 'endDate');
        $reflectionEndDateProperty->setAccessible(true);


        $actualStartDateProperty = $reflectionStartDateProperty->getValue($bookingPeriodValue);
        $actualEndDateProperty = $reflectionEndDateProperty->getValue($bookingPeriodValue);

        var_dump($actualStartDateProperty);
        var_dump($startDate);

        $this->assertEquals($startDate, $actualStartDateProperty);
        $this->assertEquals($endDate, $actualEndDateProperty);

        return $this;
    }
}