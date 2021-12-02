<?php

namespace Application\Hotel;

use Domain\Hotel\HotelFactory;
use Domain\Hotel\HotelRepository;

class HotelApplicationService
{
    private HotelRepository $hotelRepository;

    /**
     * @param HotelRepository $hotelRepository
     */
    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function createHotel(string $name,
                             string    $street,
                             string    $postalCode,
                             string    $buildingNumber,
                             string    $city,
                             string    $country): void{
        $hotel = (new HotelFactory)->create($name, $street, $postalCode, $buildingNumber, $city, $country);
        $this->hotelRepository->saveHotel($hotel);
    }
}