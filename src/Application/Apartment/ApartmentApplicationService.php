<?php
declare(strict_types=1);
namespace Application\Apartment;

use Domain\Apartment\Address;
use Domain\Apartment\Apartment;
use Domain\Apartment\Room;
use Domain\Apartment\SquareMeter;

class ApartmentApplicationService
{

    /**
     * @param string $ownerId
     * @param string $street
     * @param string $postalCode
     * @param string $houseNumber
     * @param string $apartmentNumber
     * @param string $city
     * @param string $country
     * @param string $description
     * @param array<string, double> $roomsDefinition
     */
    public function addApartment(
        string $ownerId,
        string $street,
        string $postalCode,
        string $houseNumber,
        string $apartmentNumber,
        string $city,
        string $country,
        string $description,
        array  $roomsDefinition)
    {
        /**
         * @var Address $address
         */
        $address = new Address($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country);

        /**
         * @var array<Room> $rooms
         */
        $rooms = [];

        foreach ($roomsDefinition as $name => $size){
            $rooms[] = new Room($name, new SquareMeter($size));
        }

        /**
         * @var Apartment $apartment
         */
        $apartment = new Apartment($ownerId,$address, $description);
    }
}