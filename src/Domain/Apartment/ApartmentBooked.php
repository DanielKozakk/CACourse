<?php


namespace App\Domain\Apartment;


use Symfony\Contracts\EventDispatcher\Event;

class ApartmentBooked extends Event
{
    public const NAME = 'apartment.booked';

    private string $eventId;
    private \DateTime $creationDateTime;
    private string $apartmentId;
    private string $ownerId;
    private string $tenantId;
    private \DateTime $periodStart;
    private \DateTime $periodEnd;

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

        $this->periodStart = $period->getStart();
        $this->periodEnd = $period->getEnd();

    }

    public static function create(string $apartmentId, string $ownerId, string $tenantId, \App\Domain\Apartment\Period $period): ApartmentBooked
    {
        $eventId = uniqid();
        $creationDateTime = new \DateTime();

        return new ApartmentBooked($eventId, $creationDateTime, $apartmentId, $ownerId, $tenantId, $period);
    }

    /**
     * @return string
     */
    public function getEventId(): string
    {
        return $this->eventId;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDateTime(): \DateTime
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
     * @return \DateTime
     */
    public function getPeriodStart(): \DateTime
    {
        return $this->periodStart;
    }

    /**
     * @return \DateTime
     */
    public function getPeriodEnd(): \DateTime
    {
        return $this->periodEnd;
    }


}