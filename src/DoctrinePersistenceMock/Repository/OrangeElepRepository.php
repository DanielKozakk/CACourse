<?php

namespace Domain\Repository;

use Domain\Entity\OrangeElep;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrangeElep|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrangeElep|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrangeElep[]    findAll()
 * @method OrangeElep[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrangeElepRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrangeElep::class);
    }

    // /**
    //  * @return OrangeElep[] Returns an array of OrangeElep objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrangeElep
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}