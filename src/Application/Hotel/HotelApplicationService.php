<?php


namespace App\Application\Hotel;


use App\Domain\Apartment\Room;
use App\Domain\Hotel\Hotel;
use App\Domain\Hotel\HotelFactory;

class HotelApplicationService
{

    public function createHotel(
        string $name,
        string $street,
        string $postalCode,
        string $city,
        string $country
    ) :Hotel{

        $hotelFactory = new HotelFactory();
        return $hotelFactory->create($name, $street, $postalCode, $city, $country);
    }



}