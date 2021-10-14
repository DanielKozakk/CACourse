<?php

namespace Domain\Hotel;

use Helpers\PropertiesUnwrapper;
use PHPUnit\Framework\TestCase;

class HotelTest extends TestCase
{

    use PropertiesUnwrapper;

    /**
     * @throws \ReflectionException
     */
    public function testShouldCreateHotelWithAllRequiredFields(){

        $name = 'Testowy Hotel';
        $street = "Testowa ulica";
        $postalCode = "39-242";
        $flatNumber = "542";
        $city = "Kraków";
        $country = "Polska";

        $hotelFactory=  new HotelFactory();
        $actualHotel = $hotelFactory->create($name, $street, $postalCode, $flatNumber, $city, $country);

        $this->assertSame($name, $this->getReflectionValue(Hotel::class, 'name', $actualHotel));

        $actualAddress = $this->getReflectionValue(Hotel::class, 'address', $actualHotel);

        $this->assertSame($street, $this->getReflectionValue(HotelAddress::class, 'street', $actualAddress));
        $this->assertSame($postalCode, $this->getReflectionValue(HotelAddress::class, 'postalCode', $actualAddress));
        $this->assertSame($flatNumber, $this->getReflectionValue(HotelAddress::class, 'buildingNumber', $actualAddress));
        $this->assertSame($city, $this->getReflectionValue(HotelAddress::class, 'city', $actualAddress));
        $this->assertSame($country, $this->getReflectionValue(HotelAddress::class, 'country', $actualAddress));

    }

}
