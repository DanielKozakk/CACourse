<?php

namespace Query\Apartment;

class QueryApartmentRepository
{

    private DoctrineQueryApartmentRepository $doctrineQueryApartmentRepository;
    private DoctrineQueryApartmentDetailsRepository $doctrineQueryApartmentDetailsRepository;

    /**
     * @param DoctrineQueryApartmentRepository $doctrineQueryApartmentRepository
     * @param DoctrineQueryApartmentDetailsRepository $doctrineQueryApartmentDetailsRepository
     */
    public function __construct(DoctrineQueryApartmentRepository $doctrineQueryApartmentRepository, DoctrineQueryApartmentDetailsRepository $doctrineQueryApartmentDetailsRepository)
    {
        $this->doctrineQueryApartmentRepository = $doctrineQueryApartmentRepository;
        $this->doctrineQueryApartmentDetailsRepository = $doctrineQueryApartmentDetailsRepository;
    }


    /**
     * @return array<ApartmentReadModel>
     */
    public function findAll() : array{
        return $this->doctrineQueryApartmentRepository->findAll();
    }

    public function findById(string $id) : ?ApartmentDetails
    {
        return $this->doctrineQueryApartmentDetailsRepository->findById($id);
    }
}