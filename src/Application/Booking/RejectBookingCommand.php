<?php

namespace Application\Booking;

class RejectBookingCommand
{

    private string $bookingId;

    /**
     * @param string $bookingId
     */
    public function __construct(string $bookingId)
    {
        $this->bookingId = $bookingId;
    }

    /**
     * @return string
     */
    public function getBookingId(): string
    {
        return $this->bookingId;
    }



}