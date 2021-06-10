<?php


namespace App\Infrastructure\Persistance\Doctrine\ApartmentBookingHistory;


use App\Domain\ApartmentBookingHistory\ApartmentBookingHistory;
use App\Domain\ApartmentBookingHistory\ApartmentBookingHistoryRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SqlApartmentBookingRepository implements ApartmentBookingHistoryRepository
{

    private DoctrineSqlApartmentBookingHIstoryRepository $serviceEntityRepository;

    /**
     * SqlApartmentRepository constructor.
     * @param DoctrineSqlApartmentBookingHIstoryRepository $serviceEntityRepository
     */
    public function __construct(DoctrineSqlApartmentBookingHIstoryRepository $serviceEntityRepository)
    {
        $this->serviceEntityRepository = $serviceEntityRepository;
    }

    public function existFor(string $hotelRoomId): bool
    {
        if ($this->serviceEntityRepository->findBy(['apartment_id' => $hotelRoomId])) {
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