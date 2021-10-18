<?php

namespace Domain\Apartment;

use PHPUnit\Framework\TestCase;
use ReflectionProperty;

class ApartmentTest extends TestCase
{

    const ownerId = '1234';
    const street = 'Florianska';
    const postalCode = '12-201';
    const houseNumber = '12';
    const apartmentNumber = '13';
    const city = 'Krakow';
    const country = 'Poland';
    const description = 'Nice place to stay';
    const roomsDefinition = [
        "name1" => 20.0,
        "name2" => 16.0
    ];

    public function testShouldCreateApartmentWithAllInformation()
    {

        $actualApartment = (new ApartmentFactory())->create(self::ownerId, self::street, self::postalCode, self::houseNumber, self::apartmentNumber, self::city, self::country, self::description, self::roomsDefinition);

        $this->assertThatHasOwnerId($actualApartment, self::ownerId);
        $this->assertThatHasDescription($actualApartment, self::description);
        $this->assertThatHasAddress($actualApartment, self::street, self::postalCode, self::houseNumber, self::apartmentNumber, self::city, self::country);
        $this->assertThatHasRooms($actualApartment, self::roomsDefinition);

    }

    private function assertThatHasOwnerId(Apartment $actual, string $ownerId)
    {
        $reflectionProperty = new ReflectionProperty(Apartment::class, 'ownerId');
        $reflectionProperty->setAccessible(true);
        $actualOwnerId = $reflectionProperty->getValue($actual);

        $this->assertSame($actualOwnerId, self::ownerId);
    }

    private function assertThatHasDescription(Apartment $actual, string $description)
    {
        $reflectionProperty = new ReflectionProperty(Apartment::class, 'description');
        $reflectionProperty->setAccessible(true);
        $actualDescription = $reflectionProperty->getValue($actual);

        $this->assertSame($actualDescription, $description);
    }

    private function assertThatHasAddress(Apartment $actual, string $street, string $postalCode, string $houseNumber, string $apartmentNumber, string $city, string $country)
    {
        $addressOfApartmentProperty = new ReflectionProperty(Apartment::class, 'address');
        $addressOfApartmentProperty->setAccessible(true);

        $originalAddress = $addressOfApartmentProperty->getValue($actual);

        $addressProperties = [
            'street' => new ReflectionProperty(ApartmentAddress::class, 'street'),
            'postalCode' => new ReflectionProperty(ApartmentAddress::class, 'postalCode'),
            'houseNumber' => new ReflectionProperty(ApartmentAddress::class, 'houseNumber'),
            'apartmentNumber' => new ReflectionProperty(ApartmentAddress::class, 'apartmentNumber'),
            'city' => new ReflectionProperty(ApartmentAddress::class, 'city'),
            'country' => new ReflectionProperty(ApartmentAddress::class, 'country'),
        ];
        foreach ($addressProperties as $property){
            $property->setAccessible(true);
        }


        $this->assertSame($addressProperties['street']->getValue($originalAddress), $street);
        $this->assertSame($addressProperties['postalCode']->getValue($originalAddress), $postalCode);
        $this->assertSame($addressProperties['houseNumber']->getValue($originalAddress), $houseNumber);
        $this->assertSame($addressProperties['apartmentNumber']->getValue($originalAddress), $apartmentNumber);
        $this->assertSame($addressProperties['city']->getValue($originalAddress), $city);
        $this->assertSame($addressProperties['country']->getValue($originalAddress), $country);

    }

    private function assertThatHasRooms(Apartment $actual, array $roomsDefinition)
    {
        $reflectionProperty = new ReflectionProperty(Apartment::class, 'rooms');
        $reflectionProperty->setAccessible(true);
        $actualRooms = $reflectionProperty->getValue($actual);

        $nameReflectionProperty = new ReflectionProperty(Room::class, 'name');
        $squareMeterReflectionProperty = new ReflectionProperty(Room::class, 'squareMeter');
        $nameReflectionProperty->setAccessible(true);
        $squareMeterReflectionProperty->setAccessible(true);


        $roomsDefinitionNames = array_keys($roomsDefinition);
        $this->assertSame($roomsDefinitionNames[0], $nameReflectionProperty->getValue($actualRooms[0]));
        $this->assertSame($roomsDefinitionNames[1], $nameReflectionProperty->getValue($actualRooms[1]));

        $sizeReflectionProperty = new ReflectionProperty(SquareMeter::class, 'size');
        $sizeReflectionProperty->setAccessible(true);


        $this->assertSame($roomsDefinition['name1'], $sizeReflectionProperty->getValue($squareMeterReflectionProperty->getValue($actualRooms[0])));
        $this->assertSame($roomsDefinition['name2'], $sizeReflectionProperty->getValue($squareMeterReflectionProperty->getValue($actualRooms[1])));

        $this->assertSameSize($roomsDefinition, $actualRooms);

    }
}
