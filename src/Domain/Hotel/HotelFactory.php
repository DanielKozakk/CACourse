<?php

namespace Domain\Hotel;

class HotelFactory
{
    public function create(string $name, string $street, string $buildingNumber, string $postalCode, string $city, string $country){

        $hotelAddress = new HotelAddress($street, $buildingNumber, $postalCode, $city, $country);

        return new Hotel($name, $hotelAddress);
    }

}