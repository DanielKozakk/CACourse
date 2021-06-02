<?php


namespace App\Infrastructure\Persistance\Doctrine;


use App\Domain\Apartment\Apartment;
use App\Domain\Apartment\ApartmentRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineSqlApartmentRepository extends ServiceEntityRepository{
    private $entityManager;

    /**
     * DoctrineApartmentRepository constructor.
     * @param $entityManager
     */
    public function __construct()
    {
        $this->entityManager = $this->getEntityManager();
    }


    public function saveApartment(Apartment $apartment)
    {
        $this->entityManager->persist($apartment);
        $this->entityManager->flush();
    }
}