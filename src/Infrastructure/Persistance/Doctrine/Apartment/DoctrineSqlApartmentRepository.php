<?php


namespace App\Infrastructure\Persistance\Doctrine\Apartment;


use App\Domain\Apartment\Apartment;
use App\Domain\Apartment\ApartmentRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class DoctrineSqlApartmentRepository extends ServiceEntityRepository{


    /**
     * DoctrineApartmentRepository constructor.
     * @param $entityManager
     */
    private $entityManager;

    public function __construct()
    {
        /**
         *  public function __construct(ManagerRegistry $registry)
        {
            parent::__construct($registry, HotelRoomBookingHistory::class);
        }
         */

        $this->entityManager = $this->getEntityManager();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function saveApartment(Apartment $apartment)
    {
        $this->entityManager->persist($apartment);
        $this->entityManager->flush();
    }

    public function findApartmentById(string $id){

        $queryBuilder = $this->createQueryBuilder('a');
        return $queryBuilder->where(':id = id')->setParameter('id', $id)->getQuery()->getResult();

    }
}