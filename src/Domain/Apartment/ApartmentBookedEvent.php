<?php

namespace Domain\Apartment;

use DateTime;

class ApartmentBookedEvent
{

    private string $eventId;
    private DateTime $creationDateTime;
    private string $apartmentId;
    private string $ownerId;
    private string $tenantId;
    private DateTime $startDate;
    private DateTime $endDate;

    /**
     * @param string $eventId
     * @param DateTime $creationDateTime
     * @param string $apartmentId
     * @param string $ownerId
     * @param string $tenantId
     * @param DateTime $startDate
     * @param DateTime $endDate
     */
    public function __construct(string $eventId, DateTime $creationDateTime, string $apartmentId, string $ownerId, string $tenantId, DateTime $startDate, DateTime $endDate)
    {
        $this->eventId = $eventId;
        $this->creationDateTime = $creationDateTime;
        $this->apartmentId = $apartmentId;
        $this->ownerId = $ownerId;
        $this->tenantId = $tenantId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;

    }


    public static function create(string $apartmentId, string $ownerId, string $tenantId,  DateTime $startDate, DateTime $endDate)
    {
        $eventId = uniqid();
        $creationDateTime = new DateTime();

        return new ApartmentBookedEvent($eventId, $creationDateTime, $apartmentId, $ownerId, $tenantId, $startDate, $endDate);
    }

    /**
     * @return string
     */
    public function getEventId(): string
    {
        return $this->eventId;
    }

    /**
     * @return DateTime
     */
    public function getCreationDateTime(): DateTime
    {
        return $this->creationDateTime;
    }

    /**
     * @return string
     */
    public function getApartmentId(): string
    {
        return $this->apartmentId;
    }

    /**
     * @return string
     */
    public function getOwnerId(): string
    {
        return $this->ownerId;
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
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }


}