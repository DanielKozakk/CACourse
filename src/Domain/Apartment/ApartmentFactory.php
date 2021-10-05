<?php

namespace Domain\Apartment;

class ApartmentFactory
{

    public function create(
        string $ownerId,
        string $street,
        string $postalCode,
        string $houseNumber,
        string $apartmentNumber,
        string $city,
        string $country,
        string $description,
        array  $roomsDefinition

    ): Apartment
    {
        $address = new ApartmentAddress($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country);

        $apartment = new Apartment($ownerId, $address, $description);
        /**
         * @var array<Room> $rooms
         */
        $rooms = [];

        foreach ($roomsDefinition as $name => $size){
            $rooms[] = new Room($name, new SquareMeter($size), $apartment);
        }

        return $apartment;
    }
}