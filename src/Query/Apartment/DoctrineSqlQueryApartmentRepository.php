<?php


namespace App\Query\Apartment;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class DoctrineSqlQueryApartmentRepository
 * @package App\Query\Apartment
 *
 */
class DoctrineSqlQueryApartmentRepository extends ServiceEntityRepository
{
    /**
     * @param string $id
     * @return ApartmentDetails|null
     */
    public function findApartmentById(string $id): ?ApartmentDetails{
        $queryBuilder = $this->createQueryBuilder('a');
        return $queryBuilder->where(':id = id')->setParameter('id', $id)->getQuery()->getResult();

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