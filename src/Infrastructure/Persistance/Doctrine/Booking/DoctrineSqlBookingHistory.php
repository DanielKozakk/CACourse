<?php


namespace App\Infrastructure\Persistance\Doctrine\Booking;


use App\Domain\Apartment\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineSqlBookingHistory extends ServiceEntityRepository
{
    /**
     * DoctrineApartmentRepository constructor.
     * @param $entityManager
     */
    private $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);

        $this->entityManager = $this->getEntityManager();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function saveBooking(Booking $apartment)
    {
        $this->entityManager->persist($apartment);
        $this->entityManager->flush();
    }

}