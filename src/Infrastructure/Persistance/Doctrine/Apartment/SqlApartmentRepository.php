<?php


namespace App\Infrastructure\Persistance\Doctrine\Apartment;


use App\Domain\Apartment\Apartment;
use App\Infrastructure\Persistance\Doctrine\Hotel\DoctrineSqlHotelRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
     * @return mixed|void
     */

    function save(Apartment $apartment)
    {
        $this->doctrineApartmentRepository->saveApartment($apartment);
    }
}