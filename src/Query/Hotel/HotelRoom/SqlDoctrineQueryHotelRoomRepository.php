<?php
//
//namespace Query\Hotel\HotelRoom;
//
//use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\ORM\EntityManagerInterface;
//use Doctrine\Persistence\ManagerRegistry;
//
//
//
//
///**
// * @method HotelRoomReadModel|null find($id, $lockMode = null, $lockVersion = null)
// * @method HotelRoomReadModel|null findOneBy(array $criteria, array $orderBy = null)
// * @method HotelRoomReadModel[]    findAll()
// * @method HotelRoomReadModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
// */
//class SqlDoctrineQueryHotelRoomRepository extends ServiceEntityRepository
//{
//
//    private EntityManagerInterface $entityManager;
//
//    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
//    {
//        parent::__construct($registry, HotelRoomReadModel::class);
//        $this->entityManager = $entityManager;
//    }
//
//    /**
//     * @param string $hotelId
//     * @return HotelRoomReadModel[]
//     */
//    public function findByHotelId(string $hotelId): array
//    {
//        return $this->findBy(['hotelId' => $hotelId]);
//    }
//
//}