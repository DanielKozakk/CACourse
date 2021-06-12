<?php


namespace App\Domain\Apartment;


interface BookingRepository
{
    public function save(Booking $booking);

    public function findById(string $getBookingId) : ?Booking;

}