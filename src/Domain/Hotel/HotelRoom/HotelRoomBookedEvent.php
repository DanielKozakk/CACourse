<?php

namespace Domain\Hotel\HotelRoom;

use DateTime;

class HotelRoomBookedEvent
{
    private string $eventId;
    private DateTime $eventCreationDateTime;
    private int $hotelRoomId;
    private int $hotelId;
    private string $tenantId;
    private array $days;

    private function __construct(string $eventId, DateTime $eventCreationDateTime, int $hotelRoomId, int $hotelId, string $tenantId, array $days)
    {
        $this->eventId = $eventId;
        $this->eventCreationDateTime = $eventCreationDateTime;
        $this->hotelRoomId = $hotelRoomId;
        $this->hotelId = $hotelId;
        $this->tenantId = $tenantId;
        $this->days = $days;
    }

    /**
     * @param int $hotelRoomId
     * @param int $hotelId
     * @param string $tenantId
     * @param array $days
     * @return HotelRoomBookedEvent
     */
    public static function create(int $hotelRoomId, int $hotelId, string $tenantId, array $days) : HotelRoomBookedEvent{
        $eventId = uniqid();
        $creationDateTime = new DateTime();

        return new HotelRoomBookedEvent($eventId, $creationDateTime, $hotelRoomId, $hotelId, $tenantId, $days);
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
    public function getEventCreationDateTime(): DateTime
    {
        return $this->eventCreationDateTime;
    }

    /**
     * @return int
     */
    public function getHotelRoomId(): int
    {
        return $this->hotelRoomId;
    }

    /**
     * @return int
     */
    public function getHotelId(): int
    {
        return $this->hotelId;
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