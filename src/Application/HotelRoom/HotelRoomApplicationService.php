<?php


namespace App\Application\HotelRoom;

use App\Domain\HotelRoom\HotelRoomFactory;
use App\Domain\HotelRoom\HotelRoomRepository;

class HotelRoomApplicationService
{

    /**
     * @var HotelRoomRepository
     */
    private $hotelRoomRepository;

    /**
     * HotelRoomApplicationService constructor.
     * @param HotelRoomRepository $hotelRoomRepository
     */
    public function __construct(HotelRoomRepository $hotelRoomRepository)
    {
        $this->hotelRoomRepository = $hotelRoomRepository;
    }

    /**
     * @param string $hotelId
     * @param int $number
     * @param array $spacesDefinition
     * @param string $description
     */
    public function add(
        int $number,
        array $spacesDefinition,
        string $description
    )
    {
        $hotelRoom =  (new HotelRoomFactory())->create($number, $spacesDefinition, $description);

        $this->hotelRoomRepository->save($hotelRoom);

    }
}