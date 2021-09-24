<?php
//
//namespace Infrastructure\Persistence\Doctrine\Hotel\HotelRoom;
//
//use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\ORM\EntityManagerInterface;
//use Domain\Hotel\HotelRoom\HotelRoom;
//use Doctrine\Persistence\ManagerRegistry;
//
///**
// * @method HotelRoom|null find($id, $lockMode = null, $lockVersion = null)
// * @method HotelRoom|null findOneBy(array $criteria, array $orderBy = null)
// * @method HotelRoom[]    findAll()
// * @method HotelRoom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
// */
//class SqlDoctrineHotelRoomRepository extends ServiceEntityRepository
//{
//    private EntityManagerInterface $entityManager;
//
//    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
//    {
//        parent::__construct($registry, HotelRoom::class);
//        $this->entityManager = $entityManager;
//    }
//    public function addRoomToHotel(HotelRoom $hotelRoom){
//
//        $this->entityManager->persist($hotelRoom);
//        $this->entityManager->flush();
//    }
//}
