<?php

namespace Domain\Hotel;

use Domain\Hotel\HotelRoom\HotelRoom;

interface HotelRepository
{
    public function saveHotel(Hotel $hotel) : void;
    public function findHotelById(int $id): Hotel;

    public function saveHotelRoom(HotelRoom $hotelRoom) : void;

    public function findHotelRoomById(int $id) : HotelRoom;
}