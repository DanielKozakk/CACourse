<?php

namespace Domain\Apartment;

use DateInterval;
use DatePeriod;
use DateTime;
class Period
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

    /**
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @return DateTime[]
     */
    public function asDateTimeArray(): array
    {
        $startDate = clone $this->getStartDate();
        $endDate = clone $this->getEndDate();

        $period = new DatePeriod($startDate, new DateInterval('P1D'), $endDate->add(new DateInterval('P1D')));
        $arrayOfDateTimes = [];
        foreach ($period as $date) {
            $arrayOfDateTimes[] = $date;
        }
        return $arrayOfDateTimes;
    }
}