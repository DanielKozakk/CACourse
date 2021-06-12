<?php


namespace App\Domain\HotelRoom;



use DateTime;

class HotelBookedEvent
{

    public const NAME = 'hotelroom.booked';

    /**
     * @var DateTime
     */
    private DateTime $hotelRoomBookedCreationTime;
    /**
     * @var string
     */
    private string $eventId;
    /**
     * @var string
     */
    private string $hotelId;
    /**
     * @var string
     */
    private string $hotelRoomId;
    /**
     * @var string
     */
    private string $tenantId;

    /**
     * @var DateTime[]
     */
    private array $days;


    /**
     * HotelRoomBookedEvent constructor.
     * @param DateTime $hotelRoomBookedCreationTime
     * @param string $eventId
     * @param string $hotelId
     * @param string $hotelRoomId
     * @param string $tenantId
     * @param array $days
     */
    public function __construct(DateTime $hotelRoomBookedCreationTime, string $eventId, string $hotelId, string $hotelRoomId, string $tenantId, array $days)
    {
        $this->hotelRoomBookedCreationTime = $hotelRoomBookedCreationTime;
        $this->eventId = $eventId;
        $this->hotelId = $hotelId;
        $this->hotelRoomId = $hotelRoomId;
        $this->tenantId = $tenantId;

        $this->days = $days;
    }


    public static function create(string $hotelRoomId, string $hotelId, string $tenantId, array $days): HotelBookedEvent
    {
        $eventId = uniqid();
        $creationDateTime = new DateTime();

        return new HotelBookedEvent( $creationDateTime, $eventId, $hotelRoomId, $hotelId, $tenantId, $days);
    }

    /**
     * @return DateTime
     */
    public function getHotelRoomBookedCreationTime(): DateTime
    {
        return $this->hotelRoomBookedCreationTime;
    }

    /**
     * @return string
     */
    public function getEventId(): string
    {
        return $this->eventId;
    }

    /**
     * @return string
     */
    public function getHotelId(): string
    {
        return $this->hotelId;
    }

    /**
     * @return string
     */
    public function getHotelRoomId(): string
    {
        return $this->hotelRoomId;
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