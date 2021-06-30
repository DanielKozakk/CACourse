<?php


namespace App\Domain\Apartment;


class ApartmentFactory
{

    /**
     * ApartmentFactory constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param String $street
     * @param string $postalCode
     * @param string $houseNumber
     * @param string $apartmentNumber
     * @param string $city
     * @param string $country
     * @param array $roomsDefinition
     * @param string $ownerId
     * @param string $description
     * @return Apartment
     */
    public function create(
        string $street,
        string $postalCode,
        string $houseNumber,
        string $apartmentNumber,
        string $city,
        string $country,
        array $roomsDefinition,
        string $ownerId,
        string $description): Apartment
    {
        $address = new Address($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country);
        /**
         * @var $name string
         * @var $size float
         */
        $newApartment = new Apartment($ownerId,$address,$description);
        foreach ($roomsDefinition as $name => $size) {
            $newApartment->addRoom(new Room($name, new SquareMeter($size), $newApartment));
        }
        return $newApartment;
    }
}