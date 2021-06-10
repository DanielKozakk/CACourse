<?php


namespace App\Application\Booking;


class BookingRejectCommand
{

    private string $bookingId;

    /**
     * BookingRejectCommand constructor.
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