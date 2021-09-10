<?php

namespace Domain\Apartment\ApartmentBookingHistory;

class ApartmentBookingHistory
{

    private string $apartmentId;

    /**
     * @param string $apartmentId
     */
    public function __construct(string $apartmentId)
    {
        $this->apartmentId = $apartmentId;
    }

    public function add(ApartmentBooking $apartmentBooking){

    }

}