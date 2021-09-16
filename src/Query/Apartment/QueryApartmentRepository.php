<?php

namespace Query\Apartment;

class QueryApartmentRepository
{

    private DoctrineQueryApartmentRepository $springQueryApartmentRepository;

    /**
     * @param DoctrineQueryApartmentRepository $springQueryApartmentRepository
     */
    public function __construct(DoctrineQueryApartmentRepository $springQueryApartmentRepository)
    {
        $this->springQueryApartmentRepository = $springQueryApartmentRepository;
    }


    /**
     * @return array<ApartmentReadModel>
     */
    public function findAll() : array{
        return $this->springQueryApartmentRepository->findAll();
    }
}