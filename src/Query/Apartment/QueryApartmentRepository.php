<?php

namespace Query\Apartment;

class QueryApartmentRepository
{

    private DoctrineQueryApartmentRepository $doctrineQueryApartmentRepository;

    /**
     * @param DoctrineQueryApartmentRepository $doctrineQueryApartmentRepository
     */
    public function __construct(DoctrineQueryApartmentRepository $doctrineQueryApartmentRepository)
    {
        $this->doctrineQueryApartmentRepository = $doctrineQueryApartmentRepository;
    }


    /**
     * @return array<ApartmentReadModel>
     */
    public function findAll() : array{
        return $this->doctrineQueryApartmentRepository->findAll();
    }

    public function findById(string $id) : ?ApartmentDetails
    {
        return $this->doctrineQueryApartmentRepository->findById($id);
    }
}