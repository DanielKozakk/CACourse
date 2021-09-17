<?php

namespace Query\Hotel;

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


    public function findAll()
    {
        $this->sqlDoctrineQueryHotelRepository->fi
    }
}