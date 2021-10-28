<?php

namespace Domain\Apartment;

use DataFixtures\ApartmentFixture;
use Helpers\PropertiesUnwrapper;
use PHPUnit\Framework\Assert;
use ReflectionException;
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

    /**
     * @throws ReflectionException
     */
    public function hasOwnerIdEqualsTo(string $ownerId): ApartmentAssertion
    {
        $actual = $this->getReflectionValue(Apartment::class, 'ownerId', $this->actual);

        $this->assertSame($actual, $ownerId);
        return $this;
    }

    public function hasDescriptionEqualsTo(string $description) : ApartmentAssertion
    {
        $actualDescription = $this->getReflectionValue(Apartment::class, 'description', $this->actual);
        $this->assertSame($actualDescription, $description);
        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public function hasAddressEqualsTo(string $street, string $postalCode, string $houseNumber, string $apartmentNumber, string $city, string $country): ApartmentAssertion
    {
        $actualAddress = $this->getReflectionValue(Apartment::class, 'address', $this->actual);

        $actualAddressProperties = [
            'street' => $this->getReflectionValue(ApartmentAddress::class, 'street', $actualAddress),
            'postalCode' => $this->getReflectionValue(ApartmentAddress::class, 'postalCode', $actualAddress),
            'houseNumber' => $this->getReflectionValue(ApartmentAddress::class, 'houseNumber', $actualAddress),
            'apartmentNumber' => $this->getReflectionValue(ApartmentAddress::class, 'apartmentNumber', $actualAddress),
            'city' => $this->getReflectionValue(ApartmentAddress::class, 'city', $actualAddress),
            'country' => $this->getReflectionValue(ApartmentAddress::class, 'country', $actualAddress),
        ];

        $this->assertSame($actualAddressProperties['street'], $street);
        $this->assertSame($actualAddressProperties['postalCode'], $postalCode);
        $this->assertSame($actualAddressProperties['houseNumber'], $houseNumber);
        $this->assertSame($actualAddressProperties['apartmentNumber'], $apartmentNumber);
        $this->assertSame($actualAddressProperties['city'], $city);
        $this->assertSame($actualAddressProperties['country'], $country);

        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public function hasRoomsEqualsTo(array $expectedRoomsDefinition): ApartmentAssertion
    {
        $actualRooms = $this->getReflectionValue(Apartment::class, 'rooms', $this->actual);

        $actualRoomsDefinition = [];
        /**
         * @var Room $room
         */
        foreach($actualRooms as $room){
            $roomName = $this->getReflectionValue(Room::class, 'name', $room);

            $roomSquareMeter = $this->getReflectionValue(Room::class, 'squareMeter', $room);
            /**
             * @var float
             */
            $squareMeterSize = $this->getReflectionValue(SquareMeter::class, 'size', $roomSquareMeter);

            $actualRoomsDefinition[$roomName] = $squareMeterSize;
        }

        $this->assertEqualsCanonicalizing($expectedRoomsDefinition, $actualRoomsDefinition);
        return $this;
    }
}