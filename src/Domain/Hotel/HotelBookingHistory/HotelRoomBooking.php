<?php

namespace Domain\Hotel\HotelBookingHistory;

use DateTime;

//TODO: Entity
class HotelRoomBooking
{

    private string $hotelRoomId;
    private DateTime $eventCreationDateTime;
    private string $tenantId;
    private array $days;


    /**
     * @param string $hotelRoomId
     * @param DateTime $eventCreationDateTime
     * @param string $tenantId
     * @param array $days
     */
    public function __construct(string $hotelRoomId, DateTime $eventCreationDateTime, string $tenantId, array $days)
    {
        $this->hotelRoomId = $hotelRoomId;
        $this->eventCreationDateTime = $eventCreationDateTime;
        $this->tenantId = $tenantId;
        $this->days = $days;
    }

}