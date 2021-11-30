<?php

namespace Domain\ApartmentOffer;

class Money
{
    private int $price;

    /**
     * @param int $price
     */
    public function __construct(int $price)
    {
        $this->price = $price;
    }


}