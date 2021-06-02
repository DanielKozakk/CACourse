<?php


namespace App\Infrastructure\Persistance\Doctrine\Apartment;


use App\Domain\Apartment\Apartment;
use App\Domain\Apartment\ApartmentRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineSqlApartmentRepository extends ServiceEntityRepository{


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
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function saveApartment(Apartment $apartment)
    {
        $this->entityManager->persist($apartment);
        $this->entityManager->flush();
    }
}