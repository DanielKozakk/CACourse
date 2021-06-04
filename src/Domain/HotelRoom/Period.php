<?php


namespace App\Domain\HotelRoom;


class Period
{

    /**
     * @var \DateTime
     */
    private \DateTime $start;


    /**
     * @var \DateTime
     */
    private \DateTime $end;

    /**
     * Period constructor.
     * @param \DateTime $start
     * @param \DateTime $end
     */
    public function __construct(\DateTime $start, \DateTime $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * @return \DateTime
     */
    public function getStart(): \DateTime
    {
        return $this->start;
    }

    /**
     * @return \DateTime
     */
    public function getEnd(): \DateTime
    {
        return $this->end;
    }
}