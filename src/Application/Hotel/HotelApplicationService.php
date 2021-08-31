<?php

namespace Application\Hotel;

use Domain\Hotel\Hotel;
use Domain\Hotel\HotelAddress;
use Domain\Hotel\HotelFactory;

class HotelApplicationService
{

    public function addHotel(string $name,
                             string $street,
                             string $postalCode,
                             string $flatNumber,
                             string $city,
                             string $country): void
    {


        $hotel = (new HotelFactory)->create($name, $street, $postalCode, $flatNumber, $city, $country);
    }

}