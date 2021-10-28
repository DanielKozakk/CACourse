<?php

namespace Application\Booking;

class RejectBookingCommand
{

    private int $bookingId;

    /**
     * @param int $bookingId
     */
    public function __construct(int $bookingId)
    {
        $this->bookingId = $bookingId;
    }

    /**
     * @return int
     */
    public function getBookingId(): int
    {
        return $this->bookingId;
    }



}