<?php


namespace App\Query\Apartment;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class DoctrineSqlQueryApartmentRepository
 * @package App\Query\Apartment
 *
 */
class DoctrineSqlQueryApartmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApartmentReadModel::class);
    }
    /**
     * @return ApartmentReadModel[]
     */
    public function findAll(): array
    {
        $queryBuilder = $this->createQueryBuilder('a');
        return $queryBuilder->getQuery()->getResult();
    }
}