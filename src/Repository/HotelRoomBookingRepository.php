<?php

namespace App\Repository;

use App\Entity\HotelRoomBooking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HotelRoomBooking|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelRoomBooking|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelRoomBooking[]    findAll()
 * @method HotelRoomBooking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelRoomBookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HotelRoomBooking::class);
    }

    // /**
    //  * @return HotelRoomBooking[] Returns an array of HotelRoomBooking objects
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
    public function findOneBySomeField($value): ?HotelRoomBooking
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
