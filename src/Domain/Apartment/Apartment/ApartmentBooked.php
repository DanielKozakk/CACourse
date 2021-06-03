<?php


namespace App\Domain\Apartment\Apartment;


use App\Domain\Apartment\Period;

class ApartmentBooked
{
    private string $eventId;
    private \DateTime $creationDateTime;
    private string $apartmentId;
    private string $ownerId;
    private string $tenantId;
    private Period $period;


    /**
     * ApartmentBooked constructor.
     */
    private function __construct(string $eventId,\DateTime $creationDateTime, string $apartmentId, string $ownerId, string $tenantId, Period $period )
    {
        $this->eventId = $eventId;
        $this->creationDateTime = $creationDateTime;
        $this->apartmentId = $apartmentId;
        $this->ownerId = $ownerId;
        $this->tenantId = $tenantId;
        $this->period = $period;
    }

    public function create(string $apartmentId, string $ownerId, string $tenantId, \App\Domain\Apartment\Period $period)
    {

        $eventId = uniqid();
        $creationDateTime = new \DateTime();


        return new ApartmentBooked($eventId, $creationDateTime, $apartmentId, $ownerId, $tenantId, $period);
    }
}