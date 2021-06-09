<?php


namespace App\Infrastructure\Persistance\Doctrine\HotelBookingHistory;

use App\Domain\HotelBookingHistory\HotelBookingHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HotelBookingHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelBookingHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelBookingHistory[]    findAll()
 * @method HotelBookingHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineSqlHotelBookingHistoryRepository extends ServiceEntityRepository
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
        parent::__construct($registry, HotelBookingHistory::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @param HotelBookingHistory $hotelBookingHistory
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(HotelBookingHistory $hotelBookingHistory)
    {

        $this->entityManager->persist($hotelBookingHistory);
        $this->entityManager->flush();
    }
}