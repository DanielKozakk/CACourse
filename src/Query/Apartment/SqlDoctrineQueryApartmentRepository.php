<?php

namespace Query\Apartment;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @method ApartmentReadModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApartmentReadModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApartmentReadModel[]    findAll()
 * @method ApartmentReadModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlDoctrineQueryApartmentRepository extends ServiceEntityRepository
{

    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, ApartmentReadModel::class);
        $this->entityManager = $entityManager;
    }

}