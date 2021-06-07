<?php

namespace App\Repository;

use App\Entity\ABH;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ABH|null find($id, $lockMode = null, $lockVersion = null)
 * @method ABH|null findOneBy(array $criteria, array $orderBy = null)
 * @method ABH[]    findAll()
 * @method ABH[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ABHRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ABH::class);
    }

    // /**
    //  * @return ABH[] Returns an array of ABH objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ABH
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
