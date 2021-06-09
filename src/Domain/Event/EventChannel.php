<?php


namespace App\Domain\Event;


use App\Domain\Apartment\ApartmentBookedEvent;
use App\Domain\HotelRoom\HotelBookedEvent;
use phpDocumentor\Reflection\Types\Integer;

interface EventChannel
{
    public function publishApartmentBooked(ApartmentBookedEvent $apartmentBooked);

    public function publishHotelRoomBooked(HotelBookedEvent $hotelRoomBooked);

}