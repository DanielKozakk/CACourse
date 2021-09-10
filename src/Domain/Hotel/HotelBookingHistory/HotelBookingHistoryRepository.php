<?php

namespace Domain\Hotel\HotelBookingHistory;

interface HotelBookingHistoryRepository
{


    public function existsFor(string $hotelRoomId): bool;

    public function findFor(string $hotelRoomId): HotelBookingHistory;

    public function save(HotelBookingHistory $hotelRoomBookingHistory): void;
}