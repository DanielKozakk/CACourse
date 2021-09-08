<?php

namespace Infrastructure\Rest\Api\Apartment;

use DateTime;

class ApartmentBookingDto
{

    private string $tenantId;
    private DateTime $start;
    private DateTime $end;

    /**
     * @param string $tenantId
     * @param DateTime $start
     * @param DateTime $end
     */
    public function __construct(string $tenantId, DateTime $start, DateTime $end)
    {
        $this->tenantId = $tenantId;
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * @return string
     */
    public function getTenantId(): string
    {
        return $this->tenantId;
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


}