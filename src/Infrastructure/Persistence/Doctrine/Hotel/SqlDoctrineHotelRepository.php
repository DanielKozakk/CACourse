<?php

namespace Infrastructure\Persistence\Doctrine\Hotel;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Hotel\Hotel;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hotel[]    findAll()
 * @method Hotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlDoctrineHotelRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Hotel::class);
        $this->entityManager = $entityManager;
    }
        public function save(Hotel $hotel){

        $this->entityManager->persist($hotel);
        $this->entityManager->flush();
    }
}
