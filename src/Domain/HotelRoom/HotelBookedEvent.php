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
     * @var DateTime
     */
    private DateTime $periodStart;

    /**
     * @var DateTime
     */
    private DateTime $periodEnd;

    /**
     * HotelRoomBookedEvent constructor.
     * @param DateTime $hotelRoomBookedCreationTime
     * @param string $eventId
     * @param string $hotelId
     * @param string $hotelRoomId
     * @param string $tenantId
     * @param DateTime $periodStart
     * @param DateTime $periodEnd
     */
    public function __construct(DateTime $hotelRoomBookedCreationTime, string $eventId, string $hotelId, string $hotelRoomId, string $tenantId, DateTime $periodStart, DateTime $periodEnd)
    {
        $this->hotelRoomBookedCreationTime = $hotelRoomBookedCreationTime;
        $this->eventId = $eventId;
        $this->hotelId = $hotelId;
        $this->hotelRoomId = $hotelRoomId;
        $this->tenantId = $tenantId;
        $this->periodStart = $periodStart;
        $this->periodEnd = $periodEnd;
    }


    public static function create(string $hotelRoomId, string $hotelId, string $tenantId, Period $period): HotelBookedEvent
    {
        $eventId = uniqid();
        $creationDateTime = new DateTime();

        return new HotelBookedEvent( $creationDateTime, $eventId, $hotelRoomId, $hotelId, $tenantId, $period->getStart(), $period->getEnd());
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
     * @return DateTime
     */
    public function getPeriodStart(): DateTime
    {
        return $this->periodStart;
    }

    /**
     * @return DateTime
     */
    public function getPeriodEnd(): DateTime
    {
        return $this->periodEnd;
    }




}