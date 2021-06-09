<?php


namespace App\Infrastructure\Persistance\Doctrine\HotelBookingHistory;


use App\Domain\ApartmentBookingHistory\HotelRoomBookingHistory;
use App\Domain\ApartmentBookingHistory\ApartmentBookingHistoryRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
/**
 * @method HotelRoomBookingHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelRoomBookingHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelRoomBookingHistory[]    findAll()
 * @method HotelRoomBookingHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlHotelRoomBookingHistoryRepository implements ApartmentBookingHistoryRepository
{

    private DoctrineSqlHotelBookingHistoryRepository $serviceEntityRepository;

    /**
     * SqlApartmentRepository constructor.
     * @param DoctrineSqlHotelBookingHistoryRepository $serviceEntityRepository
     */
    public function __construct(DoctrineSqlHotelBookingHistoryRepository $serviceEntityRepository)
    {
        $this->serviceEntityRepository = $serviceEntityRepository;
    }

    public function existFor(string $hotelRoomId): bool
    {
        if ($this->serviceEntityRepository->findBy(['hotel_room_id' => $hotelRoomId])) {
            return true;
        } else {
            return false;
        }
    }

    public function findFor(string $apartmentId): HotelRoomBookingHistory|null
    {
        return $this->serviceEntityRepository->find($apartmentId);
    }

    public function save(HotelRoomBookingHistory $apartmentBookingHistory)
    {
        $this->serviceEntityRepository->save($apartmentBookingHistory);
    }
}