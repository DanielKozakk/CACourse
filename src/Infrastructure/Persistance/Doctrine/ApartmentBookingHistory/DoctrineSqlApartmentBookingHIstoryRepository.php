<?php


namespace App\Infrastructure\Persistance\Doctrine\ApartmentBookingHistory;


use App\Domain\Apartment\Apartment;
use App\Domain\ApartmentBookingHistory\ApartmentBookingHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineSqlApartmentBookingHIstoryRepository extends ServiceEntityRepository
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
        parent::__construct($registry, ApartmentBookingHistory::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @param ApartmentBookingHistory $apartmentBookingHistory
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(ApartmentBookingHistory $apartmentBookingHistory)
    {
        $this->entityManager->persist($apartmentBookingHistory);
        $this->entityManager->flush();
    }
}