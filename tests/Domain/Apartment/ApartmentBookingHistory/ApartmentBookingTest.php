<?php

namespace Domain\Apartment\ApartmentBookingHistory;

use DateTime;
use PHPUnit\Framework\TestCase;

class ApartmentBookingTest extends TestCase
{
    public function testShouldCreateApartmentBookingWithAllRequiredFields(){

        $bookingCreatioDateTime = DateTime::createFromFormat('d-m-Y H:i', '01-06-2021 13:35');
        $ownerId = '1234';
        $tenantId = '5678';

        $startDate = DateTime::createFromFormat('d-m-Y', '20-06-2021');
        $endDate = DateTime::createFromFormat('d-m-Y', '21-06-2021');


        $actual = ApartmentBooking::start($bookingCreatioDateTime,$ownerId,$tenantId,new BookingPeriod($startDate, $endDate));

        $chuj = new huj();

//        $asercja = ApartmentBookingAssertion::assert($actual);


//        ApartmentBookingAssertion::assert($actual)
//            ->hasBookingDateTimeEqualTo($bookingCreatioDateTime);
//            ->hasOwnerIdEqualTo($ownerId)
//            ->hasTenantIdEqualTo($tenantId)
//            ->hasBookingPeriodThatHas($startDate, $endDate);

    }

}
