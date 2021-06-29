<?php


namespace App\Query\Hotel;


use App\Query\Apartment\RoomReadModel;
use App\Query\HotelRoom\DoctrineSqlQueryHotelRoomRepository;

class QueryHotelRepository
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
     * @return HotelReadModel[]
     */
    public function getAllHotels(): array
    {
        return $this->doctrineSqlQueryHotelRepository->findAll();
    }

}