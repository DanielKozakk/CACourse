<?php

namespace Domain\Hotel\HotelRoom;

interface HotelRoomRepository
{

    public function save(HotelRoom $hotelRoom) : void;
}