<?php


namespace App\Domain\Apartment;

use DateInterval;
use DatePeriod;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Period
 * @package App\Domain\Apartment
 *
 */
class Period
{

    /**
     * @var DateTime
     *
     */
    private DateTime $start;


    /**
     * @var DateTime
     *
     */
    private DateTime $end;

    /**
     * Period constructor.
     * @param DateTime $start
     * @param DateTime $end
     */
    public function __construct(DateTime $start, DateTime $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * @return DateTime
     */
    public function getStart(): DateTime
    {
        return $this->start;
    }

    /**
     * @return DateTime
     */
    public function getEnd(): DateTime
    {
        return $this->end;
    }

    /**
     * @return DateTime[]
     */
    public function asDateTimeArray(): array
    {
        $period = new DatePeriod($this->getStart(), new DateInterval('P1D'), $this->getEnd()->add(new DateInterval('P1D')));
        $arrayOfDateTimes = [];
        foreach ($period as $date) {
            $arrayOfDateTimes[] = $date;
        }
        return $arrayOfDateTimes;
    }
}
