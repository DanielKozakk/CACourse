<?php

namespace Domain\Hotel;

class HotelFactory
{
    public function create(string $name,
                           string $street,
                           string $postalCode,
                           string $flatNumber,
                           string $city,
                           string $country) : Hotel
    {

        $hotelAddress = new HotelAddress($street,$flatNumber,  $postalCode, $city, $country);

        return new Hotel($name, $hotelAddress);
    }

}