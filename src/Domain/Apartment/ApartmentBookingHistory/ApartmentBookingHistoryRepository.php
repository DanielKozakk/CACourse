<?php

namespace Domain\Apartment\ApartmentBookingHistory;

interface ApartmentBookingHistoryRepository
{
    public function existsFor(int $apartmentId): bool;
    public function findFor(int $apartmentId): ApartmentBookingHistory;
    public function save(ApartmentBookingHistory $apartmentBookingHistory): void;

}