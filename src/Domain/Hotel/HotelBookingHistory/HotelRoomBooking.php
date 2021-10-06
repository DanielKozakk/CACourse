<?php

namespace Domain\Hotel\HotelBookingHistory;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class HotelRoomBooking
{
    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private DateTime $eventCreationDateTime;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $tenantId;

    /**
     * @var array
     * @ORM\Column(type="array")
     */
    private array $days;

    /**
     * @var HotelRoomBookingHistory
     * @ORM\ManyToOne(targetEntity="HotelRoomBookingHistory", inversedBy="bookings")
     */
    private HotelRoomBookingHistory $hotelRoomBookingHistory;

    /**
     * @param DateTime $eventCreationDateTime
     * @param string $tenantId
     * @param array $days
     */
    public function __construct(DateTime $eventCreationDateTime, string $tenantId, array $days)
    {
        $this->eventCreationDateTime = $eventCreationDateTime;
        $this->tenantId = $tenantId;
        $this->days = $days;
    }
}