<?php

namespace Query\Apartment;

class QueryApartmentRepository
{

    private SqlDoctrineQueryApartmentReadModelRepository $sqlDoctrineQueryApartmentRepository;
    private SqlDoctrineQueryApartmentBookingHistoryRepository $sqlDoctrineQueryApartmentBookingHistoryRepository;

    /**
     * @param SqlDoctrineQueryApartmentReadModelRepository $sqlDoctrineQueryApartmentRepository
     * @param SqlDoctrineQueryApartmentBookingHistoryRepository $sqlDoctrineQueryApartmentBookingHistoryRepository
     */
    public function __construct(SqlDoctrineQueryApartmentReadModelRepository $sqlDoctrineQueryApartmentRepository, SqlDoctrineQueryApartmentBookingHistoryRepository $sqlDoctrineQueryApartmentBookingHistoryRepository)
    {
        $this->sqlDoctrineQueryApartmentRepository = $sqlDoctrineQueryApartmentRepository;
        $this->sqlDoctrineQueryApartmentBookingHistoryRepository = $sqlDoctrineQueryApartmentBookingHistoryRepository;
    }

//
//    /**
//     * @return array<ApartmentBookingHistoryReadModel>
//     */
//    public function findAll() : array{
//        return $this->sqlDoctrineQueryApartmentRepository->findAll();
//    }
//

    public function findById(string $id): ?ApartmentDetails
    {
        $apartmentReadModel = $this->sqlDoctrineQueryApartmentRepository->findOneById($id);
        $apartmentBookingHistoryReadModel = $this->sqlDoctrineQueryApartmentBookingHistoryRepository->findOneById($id);
        if (isset($apartmentReadModel) && isset($apartmentBookingHistoryReadModel)) {
            return new ApartmentDetails($apartmentReadModel, $apartmentBookingHistoryReadModel);
        }
        return null;
    }
}