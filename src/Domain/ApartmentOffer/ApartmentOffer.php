<?php

namespace Domain\ApartmentOffer;

use DateTime;

class ApartmentOffer
{
    private int $apartmentId;
    private ApartmentAvailability $availability;
    private Money $price;

    /**
     * @param int $apartmentId
     * @param ApartmentAvailability $availability
     * @param Money $price

     */
    public function __construct(int                   $apartmentId,
                                Money                 $price,
                                ApartmentAvailability $availability)
    {
        $this->apartmentId = $apartmentId;
        $this->availability = $availability;
        $this->price = $price;
    }
}