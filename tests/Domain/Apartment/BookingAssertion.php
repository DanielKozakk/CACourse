<?php

namespace Domain\Apartment;

use Helpers\PropertiesUnwrapper;
use PHPUnit\Framework\Assert;
use ReflectionException;


class BookingAssertion extends Assert
{
    use PropertiesUnwrapper;

    private Booking $actual;

    /**
     * @param Booking $actual
     */
    private function __construct(Booking $actual)
    {
        $this->actual = $actual;
    }

    public static function assert(Booking $booking): self{
        return new BookingAssertion($booking);
    }

    /**
     * @throws ReflectionException
     */
    public function isOpen() : self{

        $actualBookingStatus = $this->getReflectionValue(Booking::class, 'bookingStatus', $this->actual);
        $actualBookingStatusState = $this->getReflectionValue(BookingStatus::class, 'state', $actualBookingStatus);

        $this->assertEquals(BookingStatus::$OPEN, $actualBookingStatusState);

        return $this;
    }


    /**
     * @throws ReflectionException
     */
    public function hasRentalTypeEqualsTo($expected) : self{

        $actualRentalType = $this->getReflectionValue(Booking::class, 'rentalType', $this->actual);
        $actualRentalTypeState = $this->getReflectionValue(RentalType::class, 'state', $actualRentalType);

        $this->assertEquals($expected, $actualRentalTypeState);

        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public function hasRentalPlaceIdEqualsTo($expected) : self{

        $actual = $this->getReflectionValue(Booking::class, 'rentalPlaceId', $this->actual);

        $this->assertEquals($expected, $actual);

        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public function hasTenantIdEqualsTo($expected) : self{

        $actual = $this->getReflectionValue(Booking::class, 'tenantId', $this->actual);
        $this->assertEquals($expected, $actual);

        return $this;
    }
    /**
     * @throws ReflectionException
     */
    public function hasDaysEqualsTo($expected) : self{

        $actual = $this->getReflectionValue(Booking::class, 'days', $this->actual);
        $this->assertEquals($expected, $actual);

        return $this;
    }

}