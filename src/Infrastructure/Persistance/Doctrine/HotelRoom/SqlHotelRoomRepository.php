<?php


namespace App\Infrastructure\Persistance\Doctrine\HotelRoom;


use App\Domain\HotelRoom\HotelRoom;
use App\Domain\HotelRoom\HotelRoomRepository;

class SqlHotelRoomRepository implements HotelRoomRepository
{
    /**
     * @var DoctrineSqlHotelRoomRepository
     */
    private $doctrineSqlHotelRoomRepository;

    /**
     * SqlHotelRoomRepository constructor.
     * @param DoctrineSqlHotelRoomRepository $doctrineSqlHotelRoomRepository
     */
    public function __construct(DoctrineSqlHotelRoomRepository $doctrineSqlHotelRoomRepository)
    {
        $this->doctrineSqlHotelRoomRepository = $doctrineSqlHotelRoomRepository;
    }


    public function save(HotelRoom $hotelRoom)
    {
        $this->doctrineSqlHotelRoomRepository->saveHotelRoom($hotelRoom);
    }

    public function findHotelRoomById($id) : HotelRoom{
        return $this->doctrineSqlHotelRoomRepository->findHotelRoomById($id);
    }
}