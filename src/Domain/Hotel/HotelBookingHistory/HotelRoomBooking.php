<?php

namespace Domain\Hotel\HotelBookingHistory;

use DateTime;

//TODO: Entity
class HotelRoomBooking
{


    private DateTime $eventCreationDateTime;
    private string $tenantId;
    private array $days;


    /**
     * @param DateTime $eventCreationDateTime
     * @param string $tenantId
     * @param array $days
     */
    public function __construct( DateTime $eventCreationDateTime, string $tenantId, array $days)
    {

        $this->eventCreationDateTime = $eventCreationDateTime;
        $this->tenantId = $tenantId;
        $this->days = $days;
    }

}