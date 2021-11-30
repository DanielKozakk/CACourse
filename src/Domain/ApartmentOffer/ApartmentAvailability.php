<?php

namespace Domain\ApartmentOffer;

use DateTime;

class ApartmentAvailability
{
    private DateTime $start;
    private DateTime $end;

    /**
     * @param DateTime $start
     * @param DateTime $end
     */
    public function __construct(DateTime $start, DateTime $end)
    {
        $this->start = $start;
        $this->end = $end;
    }
}