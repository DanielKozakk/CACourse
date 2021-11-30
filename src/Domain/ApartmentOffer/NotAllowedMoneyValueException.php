<?php

namespace Domain\ApartmentOffer;

use Exception;

class NotAllowedMoneyValueException extends Exception
{
    public function __construct($price)
    {
        parent::__construct("Price "."$price"." is lower than zero.");
    }
}