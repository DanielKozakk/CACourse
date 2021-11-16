<?php

namespace Query\Apartment;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @method ApartmentBookingHistoryReadModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApartmentBookingHistoryReadModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApartmentBookingHistoryReadModel[]    findAll()
 * @method ApartmentBookingHistoryReadModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlDoctrineQueryApartmentBookingHistoryRepository extends ServiceEntityRepository
{

    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, ApartmentBookingHistoryReadModel::class);
        $this->entityManager = $entityManager;
    }

    public function findOneById(string $id): ?ApartmentBookingHistoryReadModel
    {
        return $this->findOneBy(['id'=>$id]);
    }
    public function save(ApartmentBookingHistoryReadModel $apartmentBookingHistoryReadModel){
        $this->entityManager->persist($apartmentBookingHistoryReadModel);
        $this->entityManager->flush();
    }
}