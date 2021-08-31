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

    ){
        $address = new Address($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country);

        /**
         * @var array<Room> $rooms
         */
        $rooms = [];

        foreach ($roomsDefinition as $name => $size){
            $rooms[] = new Room($name, new SquareMeter($size));
        }

        return (new Apartment($ownerId,$address, $description, $rooms));
    }
}