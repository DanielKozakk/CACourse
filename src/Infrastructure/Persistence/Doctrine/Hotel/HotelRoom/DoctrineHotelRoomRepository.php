<?php

namespace Infrastructure\Persistence\Doctrine\Hotel\HotelRoom;

use Domain\Hotel\HotelRepository;
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
        $this->sqlDoctrineHotelRoomRepository->addRoomToHotel($hotelRoom);
    }
}