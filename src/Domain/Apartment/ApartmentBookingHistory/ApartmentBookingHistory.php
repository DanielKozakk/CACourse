<?php

namespace Domain\Apartment\ApartmentBookingHistory;

class ApartmentBookingHistory
{
    /**
     * @var string
     */
    private string $apartmentId;

    /**
     * @var array<ApartmentBooking>
     */
    private array $apartmentBookingList;

    /**
     * @param string $apartmentId
     * @param ApartmentBooking[] $apartmentBookingList
     */
    public function __construct(string $apartmentId, array $apartmentBookingList)
    {
        $this->apartmentId = $apartmentId;
        $this->apartmentBookingList = $apartmentBookingList;
    }


    public function add(ApartmentBooking $apartmentBooking){

    }

}