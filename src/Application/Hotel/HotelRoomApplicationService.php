<?php


namespace App\Application\Hotel;


use App\Domain\Apartment\Room;
use App\Domain\Hotel\Hotel;
use App\Domain\Hotel\HotelFactory;
use App\Domain\HotelRoom\HotelRoom;
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
        string $hotelId,
        int $number,
        array $spacesDefinition,
        string $description
    )
    {
        $hotelRoom =  (new HotelRoomFactory())->create($hotelId, $number, $spacesDefinition, $description);

        $this->hotelRoomRepository->save($hotelRoom);

    }
}