<?php

namespace Infrastructure\Persistence\Doctrine\Hotel;

use Domain\Hotel\Hotel;
use Domain\Hotel\HotelRepository;
use Domain\Hotel\HotelRoom\HotelRoom;
use Infrastructure\Persistence\Doctrine\Hotel\HotelRoom\SqlDoctrineHotelRoomRepository;
use ReflectionException;

class DoctrineHotelRepository implements HotelRepository
{

    private SqlDoctrineHotelRepository $sqlDoctrineHotelRepository;
    private SqlDoctrineHotelRoomRepository $sqlDoctrineHotelRoomRepository;

    /**
     * @param SqlDoctrineHotelRepository $sqlDoctrineHotelRepository
     * @param SqlDoctrineHotelRoomRepository $sqlDoctrineHotelRoomRepository
     */
    public function __construct(SqlDoctrineHotelRepository $sqlDoctrineHotelRepository, SqlDoctrineHotelRoomRepository $sqlDoctrineHotelRoomRepository)
    {
        $this->sqlDoctrineHotelRepository = $sqlDoctrineHotelRepository;
        $this->sqlDoctrineHotelRoomRepository = $sqlDoctrineHotelRoomRepository;
    }

    /**
     * @throws ReflectionException
     */
    public function saveHotel(Hotel $hotel): void
    {
        $this->sqlDoctrineHotelRepository->save($hotel);
    }

    public function findHotelById(int $id): Hotel
    {
        return $this->sqlDoctrineHotelRepository->find($id);
    }

    /**
     * @throws ReflectionException
     */
    public function saveHotelRoom(HotelRoom $hotelRoom): void
    {
        $this->sqlDoctrineHotelRoomRepository->addHotelRoomToHotel($hotelRoom);
    }

    public function findHotelRoomById(int $id): HotelRoom
    {
        return $this->sqlDoctrineHotelRoomRepository->find($id);
    }

}