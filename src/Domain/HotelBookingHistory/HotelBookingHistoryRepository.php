<?php


namespace App\Domain\HotelBookingHistory;


interface HotelBookingHistoryRepository
{

    public function existFor(string $hotelRoomId) : bool;

    public function findFor(string $hotelRoomId);

    public function save(HotelBookingHistory $hotelRoomBookingId);
}