<?php


namespace App\Domain\HotelRoom;


use App\Domain\Apartment\ApartmentBooked;
use App\Domain\Apartment\Period;

class HotelRoomBooked
{
    /**
     * @var \DateTime
     */
    private \DateTime $hotelRoomBookedCreationTime;
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
     * @var Period
     */
    private string $period;

    /**
     * HotelRoomBooked constructor.
     * @param \DateTime $hotelRoomBookedCreationTime
     * @param string $eventId
     * @param string $hotelRoomId
     * @param string $hotelId
     * @param string $tenantId
     * @param Period $period
     */
    private function __construct(\DateTime $hotelRoomBookedCreationTime, string $eventId, string $hotelRoomId,  string $hotelId,string $tenantId, Period $period)
    {
        $this->hotelRoomBookedCreationTime = $hotelRoomBookedCreationTime;
        $this->eventId = $eventId;
        $this->hotelId = $hotelId;
        $this->hotelRoomId = $hotelRoomId;
        $this->tenantId = $tenantId;
        $this->period = $period;
    }

    public static function create(string $hotelRoomId, string $hotelId, string $tenantId, Period $period): HotelRoomBooked
    {
        $eventId = uniqid();
        $creationDateTime = new \DateTime();

        return new HotelRoomBooked( $creationDateTime, $eventId, $hotelRoomId, $hotelId, $tenantId, $period);
    }

    /**
     * @return \DateTime
     */
    public function getHotelRoomBookedCreationTime(): \DateTime
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
     * @return Period
     */
    public function getPeriod(): Period|string
    {
        return $this->period;
    }


}