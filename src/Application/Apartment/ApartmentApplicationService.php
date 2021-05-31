<?php


namespace App\Application\Apartment;


use App\Domain\Apartment\Address;
use App\Domain\Apartment\Apartment;
use App\Domain\Apartment\Room;
use App\Domain\Apartment\SquareMeter;

class ApartmentApplicationService
{

    public function add(
        string $ownerId,
        String $street,
        string $postalCode,
        string $houseNumber,
        string $apartmentNumber,
        string $city,
        string $country,
        string $description,
        array $roomsDefinition
    ) : void{

        $address = new Address($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country);
        /**
         * @var Room[]
         */
        $rooms = [];
        /**
         * @var $name string
         * @var $size float
         */
        foreach ($roomsDefinition as $name => $size){
            $rooms[] = new Room($name, new SquareMeter($size));
        }
        $apartment = new Apartment($ownerId, $address, $description);



    }



}