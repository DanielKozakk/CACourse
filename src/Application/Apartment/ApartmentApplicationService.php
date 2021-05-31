<?php


namespace App\Application\Apartment;

use App\Domain\Apartment\ApartamentFactory;


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

        $apartment = (new ApartamentFactory())->create($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country, $roomsDefinition, $ownerId, $description);

    }




}