<?php


namespace App\Domain\Apartment;


use App\Domain\HotelRoom\HotelRoomBooked;

interface EventChannel
{

    public function publishApartmentBooked(ApartmentBooked $apartmentBooked);
    public function publishHotelRoomBooked(HotelRoomBooked $apartmentBooked);


}