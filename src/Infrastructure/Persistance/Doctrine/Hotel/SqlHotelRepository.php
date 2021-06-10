<?php

namespace App\Infrastructure\Persistance\Doctrine\Hotel;

use App\Domain\Hotel\Hotel;
use App\Domain\Hotel\HotelRepository;

class SqlHotelRepository implements HotelRepository
{

    /**
     * @var DoctrineSqlHotelRepository
     */
    private DoctrineSqlHotelRepository $doctrineHotelRepository;

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

    /**
     * @param string $id
     * @ return Hotel|null
     */
    function findById(string $id): ?Hotel
    {
       return $this->doctrineHotelRepository->find($id);
    }
}