<?php

namespace Domain\Apartment;

interface BookingRepository
{
    public function save(Booking $booking): void;

}