<?php

namespace Query\Apartment;

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

}