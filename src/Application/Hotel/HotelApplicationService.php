<?php


namespace App\Application\Hotel;


use App\Domain\Apartment\Room;
use App\Domain\Hotel\Hotel;
use App\Domain\Hotel\HotelFactory;
use App\Domain\Hotel\HotelRepository;
use App\Infrastructure\Persistance\Doctrine\Hotel\SqlHotelRepository;

class HotelApplicationService
{

    /**
     * @var HotelRepository
     */
    private HotelRepository $hotelRepository;

    /**
     * HotelApplicationService constructor.
     * @param HotelRepository $hotelRepository
     */
    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @param string $name
     * @param string $street
     * @param string $postalCode
     * @param string $city
     * @param string $country
     */
    public function saveHotel(
        string $name,
        string $street,
        string $postalCode,
        string $city,
        string $country
    )
    {
        $hotelFactory = new HotelFactory();
        $hotel = $hotelFactory->create($name, $street, $postalCode, $city, $country);
        $this->hotelRepository->save($hotel);
    }

}