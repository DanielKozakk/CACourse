<?php

namespace Domain\Apartment;

use DateTime;
use PHPUnit\Framework\TestCase;
use ReflectionException;

require_once ('BookingAssertion.php');

class BookingTest extends TestCase
{

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

        $expectedDays = $period->asDateTimeArray();

        BookingAssertion::assert($actual)
            ->isOpen()
            ->hasRentalTypeEqualsTo(RentalType::APARTMENT)
            ->hasRentalPlaceIdEqualsTo($rentalPlaceId)
            ->hasTenantIdEqualsTo($tenantId)
            ->hasDaysEqualsTo($expectedDays);

    }
}
