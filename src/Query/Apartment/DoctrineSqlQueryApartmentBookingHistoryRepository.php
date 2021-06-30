<?php


namespace App\Query\Apartment;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ApartmentBookingHistoryReadModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApartmentBookingHistoryReadModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApartmentBookingHistoryReadModel[]    findAll()
 * @method ApartmentBookingHistoryReadModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineSqlQueryApartmentBookingHistoryRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApartmentBookingHistoryReadModel::class);
    }
}