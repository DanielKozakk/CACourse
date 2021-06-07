<?php


namespace App\Domain\Event;


use App\Domain\Apartment\ApartmentBooked;
use App\Domain\HotelRoom\HotelRoomBooked;
use phpDocumentor\Reflection\Types\Integer;

interface EventChannel
{
    public function publishApartmentBooked(ApartmentBooked $apartmentBooked);

    public function publishHotelRoomBooked(HotelRoomBooked $hotelRoomBooked);

}