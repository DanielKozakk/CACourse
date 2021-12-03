<?php

namespace Query\Hotel;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @method HotelReadModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelReadModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelReadModel[]    findAll()
 * @method HotelReadModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class SqlDoctrineQueryHotelRepository extends ServiceEntityRepository
{

    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, HotelReadModel::class);
        $this->entityManager = $entityManager;
    }

    public function findOneById(string $id): ?HotelReadModel
    {
        return $this->findOneBy(['id'=>$id]);
    }

}