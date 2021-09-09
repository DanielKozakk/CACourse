<?php

namespace Domain\EventChannel;

use Domain\Apartment\ApartmentBookedEvent;

interface EventChannel
{

    public function publishApartmentBookedEvent(ApartmentBookedEvent $bookedEvent);
}