<?php


namespace App\Infrastructure\Persistance\Doctrine\Hotel;


use App\Domain\Apartment\Apartment;
use App\Domain\Hotel\Hotel;
use App\Infrastructure\Persistance\Doctrine\Hotel\DoctrineSqlHotelRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SqlHotelRepository implements \App\Domain\Hotel\HotelRepository
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
     * @param Hotel $hotel
     * @return void
     */

    function save(Hotel $hotel)
    {
        $this->doctrineHotelRepository->saveHotel($hotel);
    }
}