<?php

namespace Domain\EventChannel;

use Domain\Apartment\ApartmentBookedEvent;
use Domain\Hotel\HotelRoom\HotelRoomBookedEvent;

interface EventChannel
{

    public function publishApartmentBookedEvent(ApartmentBookedEvent $bookedEvent);

    public function publishHotelRoomBookedEvent(HotelRoomBookedEvent $hotelRoomBookedEvent);
}