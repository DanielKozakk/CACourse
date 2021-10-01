<?php
//
//namespace Domain\Apartment;
//
//use DateTime;
//use PHPUnit\Framework\TestCase;
//use ReflectionException;
//
//require_once ('BookingAssertion.php');
//
//class BookingTest extends TestCase
//{
//
//    /**
//     * @throws ReflectionException
//     */
//    public function testShouldCreateBookingApartmentWithAllRequiredFields (){
//
//        $rentalPlaceId = '9634';
//        $tenantId = '12511';
//
//        $periodStart=  DateTime::createFromFormat('d-m-Y', '09-05-1995');
//        $periodEnd=  DateTime::createFromFormat('d-m-Y', '09-05-1995');
//        $period = new Period($periodStart, $periodEnd);
//
//        $actual = Booking::bookApartment($rentalPlaceId, $tenantId, $period);
//
//        $expectedDays = [DateTime::createFromFormat('d-m-Y', '09-05-1995')];
//
//        BookingAssertion::assert($actual)
//            ->isOpen()
//            ->hasRentalTypeEqualsTo(RentalType::APARTMENT)
//            ->hasRentalPlaceIdEqualsTo($rentalPlaceId)
//            ->hasTenantIdEqualsTo($tenantId)
//            ->hasDaysEqualsTo($expectedDays);
//
//    }
//
//    /**
//     * @throws ReflectionException
//     */
//    public function testShouldCreateBookingHotelRoomWithAllRequiredFields (){
//
//        $rentalPlaceId = '5122';
//        $tenantId = '4734';
//
//        $expectedDays = [
//            DateTime::createFromFormat('d-m-Y', '09-05-1995'),
//            DateTime::createFromFormat('d-m-Y', '10-05-1995'),
//            DateTime::createFromFormat('d-m-Y', '11-05-1995'),
//            DateTime::createFromFormat('d-m-Y', '12-05-1995'),
//        ];
//
//        $actual = Booking::bookHotelRoom($rentalPlaceId, $tenantId, $expectedDays);
//
//
//        BookingAssertion::assert($actual)
//            ->isOpen()
//            ->hasRentalTypeEqualsTo(RentalType::HOTEL_ROOM)
//            ->hasRentalPlaceIdEqualsTo($rentalPlaceId)
//            ->hasTenantIdEqualsTo($tenantId)
//            ->hasDaysEqualsTo($expectedDays);
//
//    }
//}
