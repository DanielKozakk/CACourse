<?php


namespace App\Query\Apartment;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class DoctrineSqlQueryApartmentBookingHistoryRepository
 * @package App\Query\Apartment
 */
class DoctrineSqlQueryApartmentBookingHistoryRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApartmentBookingHistoryReadModel::class);
    }
}