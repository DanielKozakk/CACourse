<?php
//
//namespace Query\Apartment;
//
//class QueryApartmentRepository
//{
//
//    private SqlDoctrineQueryApartmentRepository $sqlDoctrineQueryApartmentRepository;
//    private SqlDoctrineQueryApartmentBookingHistoryRepository $sqlDoctrineQueryApartmentBookingHistoryRepository;
//
//    /**
//     * @param SqlDoctrineQueryApartmentRepository $sqlDoctrineQueryApartmentRepository
//     * @param SqlDoctrineQueryApartmentBookingHistoryRepository $sqlDoctrineQueryApartmentBookingHistoryRepository
//     */
//    public function __construct(SqlDoctrineQueryApartmentRepository $sqlDoctrineQueryApartmentRepository, SqlDoctrineQueryApartmentBookingHistoryRepository $sqlDoctrineQueryApartmentBookingHistoryRepository)
//    {
//        $this->sqlDoctrineQueryApartmentRepository = $sqlDoctrineQueryApartmentRepository;
//        $this->sqlDoctrineQueryApartmentBookingHistoryRepository = $sqlDoctrineQueryApartmentBookingHistoryRepository;
//    }
//
//
//    /**
//     * @return array<ApartmentBookingHistoryReadModel>
//     */
//    public function findAll() : array{
//        return $this->sqlDoctrineQueryApartmentRepository->findAll();
//    }
//
//    public function findById(string $id) : ?ApartmentDetails
//    {
//        return new ApartmentDetails($this->sqlDoctrineQueryApartmentRepository->findOneById($id), $this->sqlDoctrineQueryApartmentBookingHistoryRepository->findOneById($id));
//    }
//}