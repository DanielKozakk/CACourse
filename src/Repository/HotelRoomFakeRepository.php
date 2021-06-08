<?php

namespace App\Repository;

use App\Entity\HotelRoomFake;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HotelRoomFake|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelRoomFake|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelRoomFake[]    findAll()
 * @method HotelRoomFake[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelRoomFakeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HotelRoomFake::class);
    }

    // /**
    //  * @return HotelRoomFake[] Returns an array of HotelRoomFake objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HotelRoomFake
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
