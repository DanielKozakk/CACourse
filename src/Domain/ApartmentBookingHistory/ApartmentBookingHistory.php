<?php


namespace App\Domain\ApartmentBookingHistory;


class ApartmentBookingHistory
{
    private $apartmentId;

    /**
     * ApartmentBookingHistory constructor.
     * @param $apartmentId
     */
    public function __construct(string $apartmentId)
    {
        $this->apartmentId = $apartmentId;
    }

    public function add(ApartmentBooking $apartmentBooking)
    {
    }


}