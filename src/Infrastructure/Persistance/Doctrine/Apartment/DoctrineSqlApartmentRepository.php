<?php


namespace App\Infrastructure\Persistance\Doctrine\Apartment;


use App\Domain\Apartment\Apartment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineSqlApartmentRepository extends ServiceEntityRepository{

    /**
     * DoctrineApartmentRepository constructor.
     * @param $entityManager
     */
    private $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apartment::class);

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

        $queryBuilder = $this->createQueryBuilder('a');
        return $queryBuilder->where(':id = id')->setParameter('id', $id)->getQuery()->getResult();

    }
}