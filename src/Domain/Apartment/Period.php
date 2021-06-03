<?php


namespace App\Domain\Apartment;


class Period
{

    /**
     * @var \DateTime
     */
    private $start;


    /**
     * @var \DateTime
     */
    private $end;

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

}