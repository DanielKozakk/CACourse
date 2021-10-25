<?php

namespace Domain\Hotel;

use Helpers\PropertiesUnwrapper;
use PHPUnit\Framework\Assert;
use ReflectionException;

class HotelAssertion extends Assert
{
    use PropertiesUnwrapper;

    private Hotel $actual;

    private function __construct(Hotel $hotel)
    {
        $this->actual = $hotel;
    }

    public static function assert(Hotel $hotel) : self{
        return new HotelAssertion($hotel);
    }

    /**
     * @throws ReflectionException
     */
    public function hasNameEqualTo(string $expectedName): self
    {
        $actualName = $this->getReflectionValue(Hotel::class, 'name', $this->actual);
        $this->assertEquals($expectedName, $actualName);
        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public function hasAddressEqualTo(string $street, string $postalCode, string $buildingNumber, string $city, string $country): self
    {
        /**
         * @var HotelAddress
         */
        $actualAddress = $this->getReflectionValue(Hotel::class, 'address', $this->actual);

        $actualStreet = $this->getReflectionValue(HotelAddress::class, 'street', $actualAddress);
        $actualBuildingNumber = $this->getReflectionValue(HotelAddress::class, 'buildingNumber', $actualAddress);
        $actualPostalCode = $this->getReflectionValue(HotelAddress::class, 'postalCode', $actualAddress);
        $actualCity = $this->getReflectionValue(HotelAddress::class, 'city', $actualAddress);
        $actualCountry = $this->getReflectionValue(HotelAddress::class, 'country', $actualAddress);

        $this->assertEquals($street, $actualStreet);
        $this->assertEquals($buildingNumber, $actualBuildingNumber);
        $this->assertEquals($postalCode, $actualPostalCode);
        $this->assertEquals($city, $actualCity);
        $this->assertEquals($country, $actualCountry);

        return $this;
    }

}