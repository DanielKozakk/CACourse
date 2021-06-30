<?php


namespace App\Infrastructure\Persistance\Doctrine\Hotel;


use App\Domain\Hotel\Hotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hotel[]    findAll()
 * @method Hotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineSqlHotelRepository extends ServiceEntityRepository{


    /**
     * DoctrineApartmentRepository constructor.
     * @param $entityManager
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, ManagerRegistry $registry)
    {
        parent::__construct($registry, Hotel::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function saveHotel(Hotel $apartment)
    {
        $this->entityManager->persist($apartment);
        $this->entityManager->flush();
    }
}