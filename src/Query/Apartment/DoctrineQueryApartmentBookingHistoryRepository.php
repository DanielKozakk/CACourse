<?php

namespace Query\Apartment;

class DoctrineQueryApartmentBookingHistoryRepository
{

    private SqlDoctrineQueryApartmentBookingHistoryRepository $sqlDoctrineQueryApartmentDetailsRepository;

    /**
     * @param SqlDoctrineQueryApartmentBookingHistoryRepository $sqlDoctrineQueryApartmentDetailsRepository
     */
    public function __construct(SqlDoctrineQueryApartmentBookingHistoryRepository $sqlDoctrineQueryApartmentDetailsRepository)
    {
        $this->sqlDoctrineQueryApartmentDetailsRepository = $sqlDoctrineQueryApartmentDetailsRepository;
    }

    public function findById(string $id):ApartmentBookingHistoryReadModel{
        return $this->sqlDoctrineQueryApartmentDetailsRepository->findOneBy(['id' => $id]);
    }

}