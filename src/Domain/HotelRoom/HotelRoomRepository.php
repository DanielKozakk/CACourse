<?php


namespace App\Domain\HotelRoom;


interface HotelRoomRepository
{
    public function save(HotelRoom $hotelRoom);
    public function findById(string $string) : HotelRoom;

}