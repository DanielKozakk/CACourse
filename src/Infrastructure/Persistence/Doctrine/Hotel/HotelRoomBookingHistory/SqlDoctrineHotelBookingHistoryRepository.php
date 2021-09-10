<?php

namespace Infrastructure\Persistence\Doctrine\Hotel\HotelRoomBookingHistory;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
use Domain\Hotel\HotelBookingHistory\HotelBookingHistory;
use Doctrine\Persistence\ManagerRegistry;
use http\Exception\InvalidArgumentException;

/**
 * @method HotelBookingHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelBookingHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelBookingHistory[]    findAll()
 * @method HotelBookingHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlDoctrineHotelBookingHistoryRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, HotelBookingHistory::class);
        $this->entityManager = $entityManager;
    }
    public function save(HotelBookingHistory $hotelBookingHistory){

        $this->entityManager->persist($hotelBookingHistory);
        $this->entityManager->flush();
    }

    public function existsById($id) : bool {
        return (bool)$this->find($id);
    }

    public function findById($id) : HotelBookingHistory {
        return $this->find($id) ?? throw new InvalidArgumentException();
    }
}
