<?php

namespace Infrastructure\Rest\Api\Hotel\HotelRoom;

use DateTime;

class HotelBookingDto
{
    private string $tenantId;
    /**
     * @var array<DateTime>
     */
    private array $days;

    /**
     * @param string $tenantId
     * @param DateTime[] $days
     */
    public function __construct(string $tenantId, array $days)
    {
        $this->tenantId = $tenantId;
        $this->days = $days;
    }

    /**
     * @return string
     */
    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    /**
     * @return DateTime[]
     */
    public function getDays(): array
    {
        return $this->days;
    }


}