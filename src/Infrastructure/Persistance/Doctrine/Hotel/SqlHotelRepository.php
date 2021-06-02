<?php


namespace App\Infrastructure\Persistance\Doctrine\Apartment;


use App\Domain\Apartment\Apartment;
use App\Domain\Hotel\Hotel;
use App\Infrastructure\Persistance\Doctrine\DoctrineSqlApartmentRepository;
use App\Infrastructure\Persistance\Doctrine\Hotel\DoctrineSqlHotelRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SqlHotelRepository implements \App\Domain\Apartment\ApartmentRepository
{

    /**
     * @var DoctrineSqlHotelRepository
     */
    private $doctrineHotelRepository;

    /**
     * ApartmentRepository constructor.
     * @param DoctrineSqlHotelRepository $doctrineHotelRepository
     */
    public function __construct(DoctrineSqlHotelRepository $doctrineHotelRepository)
    {
        $this->doctrineHotelRepository = $doctrineHotelRepository;
    }


    /**
     * @param Hotel $apartment
     * @return void
     */

    function save(Apartment $apartment)
    {
        $this->doctrineHotelRepository->saveHotel($apartment);
    }
}