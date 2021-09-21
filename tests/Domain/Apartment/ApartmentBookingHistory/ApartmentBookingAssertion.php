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

        $actualBookingCreationDateTime = $reflectionProperty->getValue($bookingCreationDateTime);
        $this->assertEquals($actualBookingCreationDateTime, $bookingCreationDateTime);
        return $this;
    }
}


//$addressOfApartmentProperty = new ReflectionProperty(Apartment::class, 'address');
//$addressOfApartmentProperty->setAccessible(true);
//
//$originalAddress = $addressOfApartmentProperty->getValue($actual);
//
//$addressProperties = [
//    'street' => new ReflectionProperty(ApartmentAddress::class, 'street'),
//    'postalCode' => new ReflectionProperty(ApartmentAddress::class, 'postalCode'),
//    'houseNumber' => new ReflectionProperty(ApartmentAddress::class, 'houseNumber'),
//    'apartmentNumber' => new ReflectionProperty(ApartmentAddress::class, 'apartmentNumber'),
//    'city' => new ReflectionProperty(ApartmentAddress::class, 'city'),
//    'country' => new ReflectionProperty(ApartmentAddress::class, 'country'),
//];
//foreach ($addressProperties as $property){
//    $property->setAccessible(true);
//}
//
//
//$this->assertSame($addressProperties['street']->getValue($originalAddress), $street);
//$this->assertSame($addressProperties['postalCode']->getValue($originalAddress), $postalCode);
//$this->assertSame($addressProperties['houseNumber']->getValue($originalAddress), $houseNumber);
//$this->assertSame($addressProperties['apartmentNumber']->getValue($originalAddress), $apartmentNumber);
//$this->assertSame($addressProperties['city']->getValue($originalAddress), $city);
//$this->assertSame($addressProperties['country']->getValue($originalAddress), $country);
