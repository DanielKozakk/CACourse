<?php

namespace Infrastructure\Persistence\Doctrine\Apartment\ApartmentBookingHistory;

use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistoryRepository;
use ReflectionException;

class DoctrineApartmentBookingHistory implements ApartmentBookingHistoryRepository
{
    private SqlDoctrineApartmentBookingHistory $sqlDoctrineApartmentBookingHistory;

    /**
     * @param SqlDoctrineApartmentBookingHistory $sqlDoctrineApartmentBookingHistory
     */
    public function __construct(SqlDoctrineApartmentBookingHistory $sqlDoctrineApartmentBookingHistory)
    {
        $this->sqlDoctrineApartmentBookingHistory = $sqlDoctrineApartmentBookingHistory;
    }


    public function existsFor(int $apartmentId): bool
    {
        return $this->sqlDoctrineApartmentBookingHistory->existsById($apartmentId);
    }

    public function findFor(int $apartmentId): ApartmentBookingHistory
    {
        return $this->sqlDoctrineApartmentBookingHistory->findById($apartmentId);
    }

    /**
     * @throws ReflectionException
     */
    public function save(ApartmentBookingHistory $apartmentBookingHistory): void
    {
        $this->sqlDoctrineApartmentBookingHistory->save($apartmentBookingHistory);
    }
}