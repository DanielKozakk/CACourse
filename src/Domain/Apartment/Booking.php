<?php

namespace Domain\Apartment;

use Doctrine\ORM\Mapping as ORM;


//TODO: entity
class Booking
{

    /**
     * @var string
     * @ORM\Id
     */
    private string $id;
    private string $apartmentId;
    private string $tenantId;
    private Period $period;

    /**
     * @param string $apartmentId
     * @param string $tenantId
     * @param Period $period
     */
    public function __construct(string $apartmentId, string $tenantId, Period $period)
    {
        $this->apartmentId = $apartmentId;
        $this->tenantId = $tenantId;
        $this->period = $period;
    }


}