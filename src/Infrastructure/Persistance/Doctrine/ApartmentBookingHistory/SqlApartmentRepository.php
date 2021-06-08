<?php


namespace App\Infrastructure\Persistance\Doctrine\ApartmentBookingHistory;


use App\Domain\ApartmentBookingHistory\HotelRoomBookingHistory;
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

    public function save(HotelRoomBookingHistory $apartmentBookingHistory)
    {
        $this->serviceEntityRepository->save($apartmentBookingHistory);
    }
}