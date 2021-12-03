<?php

namespace Query\Hotel;

use Domain\Hotel\Hotel;

class QueryHotelRepository
{
    private SqlDoctrineQueryHotelRepository $sqlDoctrineQueryHotelRepository;

    /**
     * @param SqlDoctrineQueryHotelRepository $sqlDoctrineQueryHotelRepository
     */
    public function __construct(SqlDoctrineQueryHotelRepository $sqlDoctrineQueryHotelRepository)
    {
        $this->sqlDoctrineQueryHotelRepository = $sqlDoctrineQueryHotelRepository;
    }


    public function findAll() : array
    {
         return $this->sqlDoctrineQueryHotelRepository->findAll();
    }
    public function findOneById(int $id): ?HotelReadModel
    {
        return $this->sqlDoctrineQueryHotelRepository->findOneById($id);
    }
}