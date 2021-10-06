<?php

namespace Domain\Hotel\HotelRoom;

interface HotelRoomRepository
{

    public function save(HotelRoom $hotelRoom) : void;

    public function findById(int $id) : HotelRoom|null;
}