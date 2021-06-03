<?php


namespace App\Infrastructure\Persistance\Doctrine\Apartment;


use App\Domain\Apartment\Apartment;
use App\Domain\Apartment\ApartmentRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

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
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function saveApartment(Apartment $apartment)
    {
        $this->entityManager->persist($apartment);
        $this->entityManager->flush();
    }

    public function findApartmentById(string $id){

        $queryBuidler = $this->createQueryBuilder('a');
        return $queryBuidler->where(':id = id')->setParameter('id', $id)->getQuery()->getResult();

    }
}