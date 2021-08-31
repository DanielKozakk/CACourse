<?php
declare(strict_types=1);
namespace Application\Apartment;

use Domain\Apartment\ApartmentFactory;

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
        return (new ApartmentFactory())->create(
        $ownerId,
        $street,
        $postalCode,
        $houseNumber,
        $apartmentNumber,
        $city,
        $country,
        $description,
        $roomsDefinition);

    }
}