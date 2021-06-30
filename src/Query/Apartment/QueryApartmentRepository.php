<?php


namespace App\Query\Apartment;


use App\Infrastructure\Persistance\Doctrine\ApartmentBookingHistory\DoctrineSqlApartmentBookingHistoryRepository;

class QueryApartmentRepository
{

    private DoctrineSqlQueryApartmentRepository $apartmentRepository;
    private DoctrineSqlQueryApartmentBookingHistoryRepository $apartmentBookingHistoryRepository;

    /**
     * QueryApartmentRepository constructor.
     * @param DoctrineSqlQueryApartmentRepository $repository
     * @param DoctrineSqlApartmentBookingHistoryRepository $apartmentBookingHistoryRepository
     */
    public function __construct(DoctrineSqlQueryApartmentRepository $repository, DoctrineSqlQueryApartmentBookingHistoryRepository $apartmentBookingHistoryRepository)
    {
        $this->apartmentRepository = $repository;
        $this->apartmentBookingHistoryRepository = $apartmentBookingHistoryRepository;
    }

    /**
     * @return ApartmentReadModel[]
     */
    public function findAll(): array
    {
        return $this->apartmentRepository->findAll();
    }

    /**
     * @return ApartmentDetails|null
     */
    public function findById(string $id): ?ApartmentDetails
    {
        /** @var ApartmentReadModel $apartmentReadModel */
        $apartmentReadModel = $this->apartmentRepository->findOneBy(['id' => $id]);
        /** @var ApartmentBookingHistoryReadModel $apartmentReadModel */
        $apartmentBookingHistoryReadModel = $this->apartmentBookingHistoryRepository->findOneBy(['id' => $id]);

        if (isset($apartmentReadModel) && isset($apartmentBookingHistoryReadModel)) {
            return new ApartmentDetails($apartmentReadModel, $apartmentBookingHistoryReadModel);
        } else {
            return null;
        }
    }

}