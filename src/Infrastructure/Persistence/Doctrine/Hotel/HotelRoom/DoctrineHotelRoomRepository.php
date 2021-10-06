<?php

namespace Infrastructure\Persistence\Doctrine\Hotel\HotelRoom;

use Domain\Hotel\HotelRoom\HotelRoom;
use Domain\Hotel\HotelRoom\HotelRoomRepository;

class DoctrineHotelRoomRepository implements HotelRoomRepository
{
    private SqlDoctrineHotelRoomRepository $sqlDoctrineHotelRoomRepository;

    /**
     * @param SqlDoctrineHotelRoomRepository $sqlDoctrineHotelRoomRepository
     */
    public function __construct(SqlDoctrineHotelRoomRepository $sqlDoctrineHotelRoomRepository)
    {
        $this->sqlDoctrineHotelRoomRepository = $sqlDoctrineHotelRoomRepository;
    }


    public function save(HotelRoom $hotelRoom): void
    {
        $this->sqlDoctrineHotelRoomRepository->addHotelRoomToHotel($hotelRoom);
    }

    public function findById(string $id) : HotelRoom|null
    {
        return $this->sqlDoctrineHotelRoomRepository->findOneBy(['id' => $id]);
    }
}