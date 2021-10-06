<?php

namespace Infrastructure\Persistence\Doctrine\Apartment\ApartmentBookingHistory;

use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistoryRepository;

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


    public function existsFor(string $apartmentId): bool
    {
        return $this->sqlDoctrineApartmentBookingHistory->existsById($apartmentId);
    }

    public function findFor(string $apartmentId): ApartmentBookingHistory
    {
        return $this->sqlDoctrineApartmentBookingHistory->findById($apartmentId);
    }

    public function save(ApartmentBookingHistory $apartmentBookingHistory): void
    {
        $this->sqlDoctrineApartmentBookingHistory->save($apartmentBookingHistory);
    }
}