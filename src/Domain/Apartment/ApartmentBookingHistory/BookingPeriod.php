<?php

namespace Domain\Apartment\ApartmentBookingHistory;

use DateTime;

class BookingPeriod
{

    private DateTime $startDate;
    private DateTime $endDate;

    /**
     * @param DateTime $startDate
     * @param DateTime $endDate
     */
    public function __construct(DateTime $startDate, DateTime $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

}