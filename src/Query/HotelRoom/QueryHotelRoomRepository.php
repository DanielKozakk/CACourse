<?php


namespace App\Query\Hotel;


use App\Query\Apartment\RoomReadModel;
use App\Query\HotelRoom\DoctrineSqlQueryHotelRoomRepository;

class QueryHotelRoomRepository
{
    private DoctrineSqlQueryHotelRepository $doctrineSqlQueryHotelRepository;
    private DoctrineSqlQueryHotelRoomRepository $doctrineSqlQueryHotelRoomRepository;

    /**
     * QueryHotelRepository constructor.
     * @param DoctrineSqlQueryHotelRepository $doctrineSqlQueryHotelRepository
     * @param DoctrineSqlQueryHotelRoomRepository $doctrineSqlQueryHotelRoomRepository
     */
    public function __construct(DoctrineSqlQueryHotelRepository $doctrineSqlQueryHotelRepository, DoctrineSqlQueryHotelRoomRepository $doctrineSqlQueryHotelRoomRepository)
    {
        $this->doctrineSqlQueryHotelRepository = $doctrineSqlQueryHotelRepository;
        $this->doctrineSqlQueryHotelRoomRepository = $doctrineSqlQueryHotelRoomRepository;
    }


    /**
     * @param string $hotelId
     * @return RoomReadModel[]
     */
    public function getRoomsInHotel(string $hotelId): array
    {
        return $this->doctrineSqlQueryHotelRoomRepository->findBy(['hotelId' => $hotelId]);
    }

}