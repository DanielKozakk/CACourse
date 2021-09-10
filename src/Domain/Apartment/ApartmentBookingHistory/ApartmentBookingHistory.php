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
    private array $apartmentBookingList = [];

    /**
     * @param string $apartmentId
     * @param ApartmentBooking[] $apartmentBookingList
     */
    public function __construct(string $apartmentId)
    {
        $this->apartmentId = $apartmentId;
    }


    public function add(ApartmentBooking $apartmentBooking){

        array_push($this->apartmentBookingList, $apartmentBooking);

    }

}