<?php

namespace Infrastructure\Persistence\Doctrine\Booking;

use Domain\Apartment\Booking;
use Domain\Apartment\BookingRepository;

class DoctrineBookingRepository implements BookingRepository
{
    private SqlDoctrineBookingRepository $sqlDoctrineBookingRepository;

    /**
     * @param SqlDoctrineBookingRepository $sqlDoctrineBookingRepository
     */
    public function __construct(SqlDoctrineBookingRepository $sqlDoctrineBookingRepository)
    {
        $this->sqlDoctrineBookingRepository = $sqlDoctrineBookingRepository;
    }


    public function save(Booking $booking): void
    {
        $this->sqlDoctrineBookingRepository->save($booking);
    }
}