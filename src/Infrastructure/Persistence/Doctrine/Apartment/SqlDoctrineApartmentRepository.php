<?php

namespace Infrastructure\Persistence\Doctrine\Apartment;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Domain\Apartment\Apartment;
use Doctrine\Persistence\ManagerRegistry;

// TODO: Przetestuj czy to repo działa.
/**
 * @method Apartment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apartment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apartment[]    findAll()
 * @method Apartment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlDoctrineApartmentRepository extends ServiceEntityRepository
{



    private EntityManager $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManager $entityManager)
    {
        parent::__construct($registry, Apartment::class);
        $this->entityManager = $entityManager;
    }
    public function save(Apartment $apartment){

        $this->entityManager->persist($apartment);
        $this->entityManager->flush();
    }
}
