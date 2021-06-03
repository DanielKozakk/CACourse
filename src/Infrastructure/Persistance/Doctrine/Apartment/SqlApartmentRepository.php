<?php


namespace App\Infrastructure\Persistance\Doctrine\Apartment;

use App\Domain\Apartment\Apartment;

class SqlApartmentRepository implements \App\Domain\Apartment\ApartmentRepository
{
    /**
     * @var DoctrineSqlApartmentRepository
     */
    private $doctrineApartmentRepository;

    /**
     * ApartmentRepository constructor.
     * @param DoctrineSqlApartmentRepository $doctrineApartmentRepository
     */
    public function __construct(DoctrineSqlApartmentRepository $doctrineApartmentRepository)
    {
        $this->doctrineApartmentRepository = $doctrineApartmentRepository;
    }

    /**
     * @param Apartment $apartment
     * @return void
     */
    function save(Apartment $apartment)
    {
        $this->doctrineApartmentRepository->saveApartment($apartment);
    }

    public function findById(string $id) : Apartment
    {
        return $this->doctrineApartmentRepository->findApartmentById($id);
    }
}