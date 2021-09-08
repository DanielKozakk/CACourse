<?php

namespace Domain\Apartment;

use DateTime;

class ApartmentBookedEvent
{

    private string $apartmentId;
    private string $ownerId;
    private string $tenantId;
    private Period $period;

    /**
     * @param string $apartmentId
     * @param string $ownerId
     * @param string $tenantId
     * @param Period $period
     */
    public function __construct(string $eventId, DateTime $eventCreationDateTime, string $apartmentId, string $ownerId, string $tenantId, Period $period)
    {
        $this->apartmentId = $apartmentId;
        $this->ownerId = $ownerId;
        $this->tenantId = $tenantId;
        $this->period = $period;
    }


    public static function create(string $apartmentId, string $ownerId, string $tenantId, Period $period)
    {
        $eventId = uniqid();
        $creationDateTime = new DateTime();

        return new ApartmentBookedEvent($eventId, $creationDateTime, $apartmentId, $ownerId, $tenantId, $period);
    }
}