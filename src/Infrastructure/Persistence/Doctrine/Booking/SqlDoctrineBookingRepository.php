<?php
//
//namespace Infrastructure\Persistence\Doctrine\Booking;
//
//use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\ORM\EntityManagerInterface;
//use Doctrine\Persistence\ManagerRegistry;
//use Domain\Apartment\Booking;
//
///**
// * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
// * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
// * @method Booking[]    findAll()
// * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
// */
//class SqlDoctrineBookingRepository extends ServiceEntityRepository
//{
//
//    private EntityManagerInterface $entityManager;
//
//    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
//    {
//        parent::__construct($registry, Booking::class);
//        $this->entityManager = $entityManager;
//    }
//
//    public function save(Booking $booking){
//        $this->entityManager->persist($booking);
//        $this->entityManager->flush();
//    }
//
//    public function findById(string $id) : Booking|null
//    {
//        return $this->findOneBy(['id' => $id]);
//    }
//}