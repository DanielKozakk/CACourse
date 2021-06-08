<?php


namespace App\Domain\HotelRoomBookingHistory;


interface HotelRoomBookingHistoryRepository
{

    public function existFor(string $hotelRoomId);

    public function findFor(string $hotelRoomId);

    public function save(HotelRoomBookingHistory $hotelRoomBookingId);
}