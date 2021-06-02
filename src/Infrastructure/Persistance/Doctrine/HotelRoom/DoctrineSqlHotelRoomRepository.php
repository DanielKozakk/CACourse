<?php


namespace App\Infrastructure\Persistance\Doctrine\HotelRoom;


use App\Domain\HotelRoom\HotelRoom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineSqlHotelRoomRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * DoctrineSqlHotelRoomRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function saveHotelRoom(HotelRoom  $hotelRoom){

        $this->entityManager->persist($hotelRoom);
        $this->entityManager->flush();
    }

}