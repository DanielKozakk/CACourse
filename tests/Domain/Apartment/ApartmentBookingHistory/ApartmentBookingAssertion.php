<?php

namespace Domain\Apartment\ApartmentBookingHistory;

use DateTime;
use PHPUnit\Framework\Assert;
use ReflectionException;
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

    /**
     * @throws ReflectionException
     */
    public function hasBookingDateTimeEqualTo(DateTime $bookingCreationDateTime) :ApartmentBookingAssertion
    {
        $actualBookingDateCreation = $this->getReflectionValue(ApartmentBooking::class, 'bookingCreation', $this->actual);

        $this->assertEquals($actualBookingDateCreation, $bookingCreationDateTime);
        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public function hasOwnerIdEqualTo(string $ownerId): ApartmentBookingAssertion
    {
        $actualOwnerId = $this->getReflectionValue(ApartmentBooking::class, 'ownerId', $this->actual);
        $this->assertEquals($actualOwnerId, $ownerId);

        return $this;

    }

    /**
     * @throws ReflectionException
     */
    public function hasTenantIdEqualTo(string $tenantId): ApartmentBookingAssertion
    {
        $actualTenantId = $this->getReflectionValue(ApartmentBooking::class, 'tenantId', $this->actual);
        $this->assertEquals($actualTenantId, $tenantId);

        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public function hasBookingPeriodThatHas(DateTime $startDate, DateTime $endDate): ApartmentBookingAssertion
    {
        $actualBookingPeriod = $this->getReflectionValue(ApartmentBooking::class, 'bookingPeriod', $this->actual);

        $actualBookingPeriodStartDate = $this->getReflectionValue(BookingPeriod::class, 'startDate', $actualBookingPeriod);
        $actualBookingPeriodEndDate = $this->getReflectionValue(BookingPeriod::class, 'endDate', $actualBookingPeriod);

        $this->assertEquals($startDate, $actualBookingPeriodStartDate);
        $this->assertEquals($endDate, $actualBookingPeriodEndDate);

        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public function isStart(): ApartmentBookingAssertion
    {
        $actualBookingStep = $this->getReflectionValue(ApartmentBooking::class, 'bookingStep', $this->actual);
        $actualBookingStepState = $this->getReflectionValue(BookingStep::class, 'state', $actualBookingStep);
        $this->assertEquals($actualBookingStepState, BookingStep::START);

        return $this;
    }

    /**
     * @throws ReflectionException
     */
    private function getReflectionValue(string $classFqn, string $propertyName, object $actualObject){
        $reflectionProperty = new ReflectionProperty($classFqn, $propertyName);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($actualObject);
    }
}
