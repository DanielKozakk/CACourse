<?php

namespace Domain\Repository;

use Domain\Entity\FakeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FakeEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method FakeEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method FakeEntity[]    findAll()
 * @method FakeEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FakeEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FakeEntity::class);
    }

    // /**
    //  * @return FakeEntity[] Returns an array of FakeEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FakeEntity
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
