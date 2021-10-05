<?php

namespace Query\Hotel\HotelRoom;

class QueryHotelRoomRepository
{

    private SqlDoctrineQueryHotelRoomRepository $sqlDoctrineQueryHotelRoomRepository;

    /**
     * @param SqlDoctrineQueryHotelRoomRepository $sqlDoctrineQueryHotelRoomRepository
     */
    public function __construct(SqlDoctrineQueryHotelRoomRepository $sqlDoctrineQueryHotelRoomRepository)
    {
        $this->sqlDoctrineQueryHotelRoomRepository = $sqlDoctrineQueryHotelRoomRepository;
    }


    /**
     * @param string $hotelId
     * @return array<HotelRoomReadModel>
     */
    public function findAllByHotelId(string $hotelId) : array
    {
       return $this->sqlDoctrineQueryHotelRoomRepository->findByHotelId($hotelId);
    }
}