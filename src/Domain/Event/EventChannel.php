<?php


namespace App\Domain\Event;


use App\Domain\Apartment\ApartmentBookedEvent;
use App\Domain\HotelRoom\HotelRoomBookedEvent;
use phpDocumentor\Reflection\Types\Integer;

interface EventChannel
{
    public function publishApartmentBooked(ApartmentBookedEvent $apartmentBooked);

    public function publishHotelRoomBooked(HotelRoomBookedEvent $hotelRoomBooked);

}