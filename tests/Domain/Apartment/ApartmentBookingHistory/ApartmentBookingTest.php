<?php
//
//namespace Domain\Apartment\ApartmentBookingHistory;
//require_once ('ApartmentBookingAssertion.php');
//use DateTime;
//use PHPUnit\Framework\TestCase;
//use ReflectionException;
//
//
//class ApartmentBookingTest extends TestCase
//{
//    /**
//     * @throws ReflectionException
//     */
//    public function testShouldCreateApartmentBookingWithAllRequiredFields(){
//
//        $bookingCreationDateTime = DateTime::createFromFormat('d-m-Y H:i', '01-06-2021 13:35');
//        $ownerId = '1234';
//        $tenantId = '5678';
//
//        $startDate = DateTime::createFromFormat('d-m-Y', '20-06-2021');
//        $endDate = DateTime::createFromFormat('d-m-Y', '21-06-2021');
//
//        $actual = ApartmentBooking::start($bookingCreationDateTime,$ownerId,$tenantId,new BookingPeriod($startDate, $endDate));
//
//        ApartmentBookingAssertion::assert($actual)
//            ->isStart()
//            ->hasBookingDateTimeEqualTo($bookingCreationDateTime)
//            ->hasOwnerIdEqualTo($ownerId)
//            ->hasTenantIdEqualTo($tenantId)
//            ->hasBookingPeriodThatHas($startDate, $endDate);
//    }
//
//}
