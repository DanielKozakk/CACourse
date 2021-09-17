<?php

namespace Query\Apartment;

class QueryApartmentRepository
{

    private DoctrineQueryApartmentRepository $doctrineQueryApartmentRepository;
    private DoctrineQueryApartmentBookingHistoryRepository $doctrineQueryApartmentBookingHistoryRepository;

    /**
     * @param DoctrineQueryApartmentRepository $doctrineQueryApartmentRepository
     * @param DoctrineQueryApartmentBookingHistoryRepository $doctrineQueryApartmentBookingHistoryRepository
     */
    public function __construct(DoctrineQueryApartmentRepository $doctrineQueryApartmentRepository, DoctrineQueryApartmentBookingHistoryRepository $doctrineQueryApartmentBookingHistoryRepository)
    {
        $this->doctrineQueryApartmentRepository = $doctrineQueryApartmentRepository;
        $this->doctrineQueryApartmentBookingHistoryRepository = $doctrineQueryApartmentBookingHistoryRepository;
    }


    /**
     * @return array<ApartmentBookingHistoryReadModel>
     */
    public function findAll() : array{
        return $this->doctrineQueryApartmentRepository->findAll();
    }

    public function findById(string $id) : ?ApartmentDetails
    {
        return new ApartmentDetails($this->doctrineQueryApartmentRepository->findById($id), $this->doctrineQueryApartmentBookingHistoryRepository->findById($id));
    }
}