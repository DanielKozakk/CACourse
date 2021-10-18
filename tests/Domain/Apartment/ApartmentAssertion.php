<?php

namespace Domain\Apartment;

use DataFixtures\ApartmentFixture;
use Helpers\PropertiesUnwrapper;
use PHPUnit\Framework\Assert;
use ReflectionProperty;

class ApartmentAssertion extends Assert
{
    use PropertiesUnwrapper;

    private Apartment $actual;

    /**
     * @param Apartment $apartment
     */
    public function __construct(Apartment $apartment)
    {
        $this->actual = $apartment;
    }


    public static function assert(Apartment $apartment): ApartmentAssertion {
        return new ApartmentAssertion($apartment);
    }

    public function hasOwnerIdEqualsTo(string $ownerId): ApartmentAssertion
    {
        $reflectionProperty = new ReflectionProperty(Apartment::class, 'ownerId');
        $reflectionProperty->setAccessible(true);
        $actualOwnerId = $reflectionProperty->getValue($this->actual);

        $this->assertSame($actualOwnerId, $ownerId);
        return $this;
    }

    public function hasDescriptionEqualsTo(string $description) : ApartmentAssertion
    {
        $reflectionProperty = new ReflectionProperty(Apartment::class, 'description');
        $reflectionProperty->setAccessible(true);
        $actualDescription = $reflectionProperty->getValue($this->actual);

        $this->assertSame($actualDescription, $description);
        return $this;
    }

    public function hasAddressEqualsTo(string $street, string $postalCode, string $houseNumber, string $apartmentNumber, string $city, string $country): ApartmentAssertion
    {

        $addressOfApartmentProperty = new ReflectionProperty(Apartment::class, 'address');
        $addressOfApartmentProperty->setAccessible(true);

        $originalAddress = $addressOfApartmentProperty->getValue($this->actual);

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

        return $this;
    }

    public function hasRoomsEqualsTo(array $roomsDefinition): ApartmentAssertion
    {
        $reflectionProperty = new ReflectionProperty(Apartment::class, 'rooms');
        $reflectionProperty->setAccessible(true);
        $actualRooms = $reflectionProperty->getValue($this->actual);

        $nameReflectionProperty = new ReflectionProperty(Room::class, 'name');
        $squareMeterReflectionProperty = new ReflectionProperty(Room::class, 'squareMeter');
        $nameReflectionProperty->setAccessible(true);
        $squareMeterReflectionProperty->setAccessible(true);


        $roomsDefinitionNames = array_keys($roomsDefinition);
        $this->assertSame($roomsDefinitionNames[0], $nameReflectionProperty->getValue($actualRooms[0]));
        $this->assertSame($roomsDefinitionNames[1], $nameReflectionProperty->getValue($actualRooms[1]));

        $sizeReflectionProperty = new ReflectionProperty(SquareMeter::class, 'size');
        $sizeReflectionProperty->setAccessible(true);

        $this->assertSame($roomsDefinition[ApartmentFixture::FIRST_TEST_APARTMENT_FIST_SPACE_NAME], $sizeReflectionProperty->getValue($squareMeterReflectionProperty->getValue($actualRooms[0])));
        $this->assertSame($roomsDefinition[ApartmentFixture::FIRST_TEST_APARTMENT_SECOND_SPACE_NAME], $sizeReflectionProperty->getValue($squareMeterReflectionProperty->getValue($actualRooms[1])));

        $this->assertSameSize($roomsDefinition, $actualRooms);
        return $this;
    }


}