<?php


namespace App\Infrastructure\Persistance\Doctrine\HotelBookingHistory;


use App\Domain\HotelBookingHistory\HotelBookingHistory;
use App\Domain\HotelBookingHistory\HotelBookingHistoryRepository;
/**
 * @method HotelBookingHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelBookingHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelBookingHistory[]    findAll()
 * @method HotelBookingHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlHotelRoomBookingHistoryRepository implements HotelBookingHistoryRepository
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

    /**
     * @param string $hotelId
     * @return HotelBookingHistory|null
     */
    public function findFor(string $hotelId): HotelBookingHistory|null
    {
        return $this->serviceEntityRepository->find($hotelId);
    }

    public function save(HotelBookingHistory $hotelBookingHistory)
    {
        $this->serviceEntityRepository->save($hotelBookingHistory);
    }
}