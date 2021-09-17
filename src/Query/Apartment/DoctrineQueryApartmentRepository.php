<?php

namespace Query\Apartment;

use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistoryRepository;

class DoctrineQueryApartmentRepository
{

    private SqlDoctrineQueryApartmentRepository $sqlDoctrineQueryApartmentRepository;

    /**
     * @param SqlDoctrineQueryApartmentRepository $sqlDoctrineQueryApartmentRepository
     */
    public function __construct(SqlDoctrineQueryApartmentRepository $sqlDoctrineQueryApartmentRepository)
    {
        $this->sqlDoctrineQueryApartmentRepository = $sqlDoctrineQueryApartmentRepository;
    }


    /**
     * @return array<ApartmentReadModel>
     */
    public function findAll(): array{
        return $this->sqlDoctrineQueryApartmentRepository->findAll();
    }

    public function findById(string $id):ApartmentReadModel{
        return $this->sqlDoctrineQueryApartmentRepository->findOneBy(['id'=>$id]);
    }

}