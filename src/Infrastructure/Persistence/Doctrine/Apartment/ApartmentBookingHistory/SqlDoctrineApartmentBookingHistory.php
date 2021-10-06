<?php

namespace Infrastructure\Persistence\Doctrine\Apartment\ApartmentBookingHistory;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
use http\Exception\InvalidArgumentException;
use http\Exception\RuntimeException;

///**
// * @method ApartmentBookingHistory|null find($id, $lockMode = null, $lockVersion = null)
// * @method ApartmentBookingHistory|null findOneBy(array $criteria, array $orderBy = null)
// * @method ApartmentBookingHistory[]    findAll()
// * @method ApartmentBookingHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
// */
class SqlDoctrineApartmentBookingHistory extends ServiceEntityRepository
{

    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, ApartmentBookingHistory::class);
        $this->entityManager = $entityManager;
    }
    public function save(ApartmentBookingHistory $apartmentBookingHistory){

        $this->entityManager->persist($apartmentBookingHistory);
        $this->entityManager->flush();
    }

    public function existsById($id) : bool {
        return (bool)$this->find($id);
    }

    public function findById($id) : ApartmentBookingHistory {
        return $this->find($id) ?? throw new InvalidArgumentException();
    }

}
