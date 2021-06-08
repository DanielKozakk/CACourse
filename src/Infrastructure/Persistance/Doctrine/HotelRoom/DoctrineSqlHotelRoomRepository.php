<?php


namespace App\Infrastructure\Persistance\Doctrine\HotelRoom;


use App\Domain\HotelRoom\HotelRoom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineSqlHotelRoomRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * DoctrineSqlHotelRoomRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, ManagerRegistry $registry)
    {
        parent::__construct($registry, HotelRoom::class);
        $this->entityManager = $entityManager;
    }

    public function saveHotelRoom(HotelRoom  $hotelRoom){

        $this->entityManager->persist($hotelRoom);
        $this->entityManager->flush();
    }
    public function findHotelRoomById(string $id){

        $queryBuilder = $this->createQueryBuilder('a');
        return $queryBuilder->where(':id = id')->setParameter('id', $id)->getQuery()->getResult();

    }
}