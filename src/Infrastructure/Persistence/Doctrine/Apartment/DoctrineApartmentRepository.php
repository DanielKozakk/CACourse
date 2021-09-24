<?php
//declare(strict_types=1);
//
//namespace Infrastructure\Persistence\Doctrine\Apartment;
//
//use Doctrine\ORM\EntityManager;
//use Domain\Apartment\Apartment;
//use Domain\Apartment\ApartmentRepository;
//
//class DoctrineApartmentRepository implements ApartmentRepository
//{
//    private SqlDoctrineApartmentRepository $sqlDoctrineApartmentRepository;
//
//    /**
//     * @param SqlDoctrineApartmentRepository $sqlDoctrineApartmentRepository
//     */
//    public function __construct(SqlDoctrineApartmentRepository $sqlDoctrineApartmentRepository)
//    {
//        $this->sqlDoctrineApartmentRepository = $sqlDoctrineApartmentRepository;
//    }
//
//    public function save(Apartment $apartment) : void
//    {
//        $this->sqlDoctrineApartmentRepository->save($apartment);
//    }
//
//    public function findById(string $apartmentId) : Apartment|null
//    {
//        return $this->sqlDoctrineApartmentRepository->findOneBy(['id' => $apartmentId]);
//    }
//}