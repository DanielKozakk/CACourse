<?php


namespace App\Domain\ApartmentBookingHistory;


interface ApartmentBookingHistoryRepository
{

    public function existFor(string $hotelRoomId);

    public function findFor(string $apartmentId);

    public function save(ApartmentBookingHistory $apartmentBookingHistory);
}