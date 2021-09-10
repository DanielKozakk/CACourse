<?php

namespace Domain\Apartment\ApartmentBookingHistory;

interface ApartmentBookingHistoryRepository
{
    public function existsFor(string $apartmentId): bool;
    public function findFor(string $apartmentId): ApartmentBookingHistory;
    public function save(ApartmentBookingHistory $apartmentBookingHistory): void;

}