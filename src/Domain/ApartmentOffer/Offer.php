<?php

namespace Domain\ApartmentOffer;

use DateTime;

class Offer
{
    private int $apartmentId;
    private Money $param;
    private ApartmentAvailability $availability;
    private Money $price;

    /**
     * @param int $apartmentId
     * @param Money $param
     * @param ApartmentAvailability $availability
     * @param Money $price

     */
    public function __construct(int $apartmentId, Money $param, ApartmentAvailability $availability, Money $price)
    {
        $this->apartmentId = $apartmentId;
        $this->param = $param;
        $this->availability = $availability;
        $this->price = $price;
    }
}