<?php


namespace App\Infrastructure\Persistance\Doctrine\ApartmentBookingHistory;


use App\Domain\ApartmentBookingHistory\ApartmentBookingHistory;
use App\Domain\ApartmentBookingHistory\ApartmentBookingHistoryRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SqlApartmentRepository implements ApartmentBookingHistoryRepository
{

    private DoctrineSqlApartmentRepository $serviceEntityRepository;

    /**
     * SqlApartmentRepository constructor.
     * @param DoctrineSqlApartmentRepository $serviceEntityRepository
     */
    public function __construct(DoctrineSqlApartmentRepository $serviceEntityRepository)
    {
        $this->serviceEntityRepository = $serviceEntityRepository;
    }

    public function existFor(string $apartmentId): bool
    {
        if ($this->serviceEntityRepository->findBy(['apartment_id' => $apartmentId])) {
            return true;
        } else {
            return false;
        }
    }

    public function findFor(string $apartmentId)
    {
        return $this->serviceEntityRepository->find($apartmentId);
    }

    public function save(ApartmentBookingHistory $apartmentBookingHistory)
    {
        $this->serviceEntityRepository->save($apartmentBookingHistory);
    }
}