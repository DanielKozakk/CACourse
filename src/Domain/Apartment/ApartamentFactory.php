<?php


namespace App\Domain\Apartment;


class ApartamentFactory
{

    /**
     * ApartamentFactory constructor.
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
         * @var Room[]
         */
        $rooms = [];
        /**
         * @var $name string
         * @var $size float
         */
        foreach ($roomsDefinition as $name => $size) {
            $rooms[] = new Room($name, new SquareMeter($size));
        }
        return new Apartment($ownerId, $address, $description);
    }
}