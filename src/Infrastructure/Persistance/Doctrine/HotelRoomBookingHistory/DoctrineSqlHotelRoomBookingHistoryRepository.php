<?php


namespace App\Infrastructure\Persistance\Doctrine\HotelRoomBookingHistory;

use App\Domain\ApartmentBookingHistory\HotelRoomBookingHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HotelRoomBookingHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelRoomBookingHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelRoomBookingHistory[]    findAll()
 * @method HotelRoomBookingHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineSqlHotelRoomBookingHistoryRepository extends ServiceEntityRepository
{

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * DoctrineSqlApartmentRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, ManagerRegistry $registry)
    {
        parent::__construct($registry, HotelRoomBookingHistory::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @param HotelRoomBookingHistory $hotelRoomBookingHistory
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(HotelRoomBookingHistory $hotelRoomBookingHistory)
    {

        $this->entityManager->persist($hotelRoomBookingHistory);
        $this->entityManager->flush();
    }
}