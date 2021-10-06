<?php

namespace Infrastructure\Persistence\Doctrine\Hotel;

use Domain\Hotel\Hotel;
use Domain\Hotel\HotelRepository;

class DoctrineHotelRepository implements HotelRepository
{

    private SqlDoctrineHotelRepository $sqlDoctrineHotelRepository;

    /**
     * @param SqlDoctrineHotelRepository $sqlDoctrineHotelRepository
     */
    public function __construct(SqlDoctrineHotelRepository $sqlDoctrineHotelRepository)
    {
        $this->sqlDoctrineHotelRepository = $sqlDoctrineHotelRepository;
    }


    public function save(Hotel $hotel): void
    {
        $this->sqlDoctrineHotelRepository->save($hotel);
    }

    public function findById(int $id): ?Hotel
    {
        return $this->sqlDoctrineHotelRepository->find($id);
    }
}