<?php


namespace App\Domain\Event;


use App\Domain\Apartment\ApartmentBooked;

use App\Domain\HotelRoom\HotelRoomBooked;

class EventChannelImplementation implements EventChannel
{

    public function publishApartmentBooked(ApartmentBooked $apartmentBooked)
    {
        // TODO: Implement publishApartmentBooked() method.
    }

    public function publishHotelRoomBooked(HotelRoomBooked $apartmentBooked)
    {
        // TODO: Implement publishHotelRoomBooked() method.
    }
}