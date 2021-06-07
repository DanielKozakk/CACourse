<?php


namespace App\Domain\ApartmentBookingHistory;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class BookingPeriod
{

    private \DateTime $startDate;
    private \DateTime $endDate;

    /**
     * BookingPeriod constructor.
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     */
    public function __construct(\DateTime $startDate, \DateTime $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }


}