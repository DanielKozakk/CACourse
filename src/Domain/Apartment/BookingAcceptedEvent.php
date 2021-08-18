<?php


namespace App\Domain\Apartment;


use DateTime;

class BookingAcceptedEvent{

    public const NAME = 'booking.accepted';


    private string $eventId;
    private DateTime $creationDateTime;
    private string $rentalType;
    private string $rentalPlaceId;
    private string $tenantId;
    private array $days;


    /**
     * BookingAcceptedEvent constructor.
     * @param string $eventId
     * @param DateTime $creationDateTime
     * @param string $rentalType
     * @param string $rentalPlaceId
     * @param string $tenantId
     * @param array $days
     */
    private function __construct(string $eventId, DateTime $creationDateTime, string $rentalType, string $rentalPlaceId, string $tenantId, array $days)
    {
        $this->rentalType = $rentalType;
        $this->rentalPlaceId = $rentalPlaceId;
        $this->tenantId = $tenantId;
        $this->days = $days;
        $this->eventId = $eventId;
        $this->creationDateTime = $creationDateTime;
    }

    public static function create(RentalType $rentalType, string $rentalPlaceId, string  $tenantId, array $days): BookingAcceptedEvent
    {
        $eventId = uniqid();
        $creationDateTime = new \DateTime();

        return new BookingAcceptedEvent($eventId, $creationDateTime, $rentalType->getType(), $rentalPlaceId, $tenantId, $days);
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
    public function getRentalType(): string
    {
        return $this->rentalType;
    }

    /**
     * @return string
     */
    public function getRentalPlaceId(): string
    {
        return $this->rentalPlaceId;
    }

    /**
     * @return string
     */
    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    /**
     * @return array
     */
    public function getDays(): array
    {
        return $this->days;
    }


}