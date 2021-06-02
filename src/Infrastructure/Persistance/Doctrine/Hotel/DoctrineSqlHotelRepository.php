<?php


namespace App\Infrastructure\Persistance\Doctrine\Hotel;


use App\Domain\Apartment\Apartment;
use App\Domain\Apartment\ApartmentRepository;
use App\Domain\Hotel\Hotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class DoctrineSqlHotelRepository extends ServiceEntityRepository{


    /**
     * DoctrineApartmentRepository constructor.
     * @param $entityManager
     */
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = $this->getEntityManager();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function saveHotel(Hotel $apartment)
    {
        $this->entityManager->persist($apartment);
        $this->entityManager->flush();
    }
}