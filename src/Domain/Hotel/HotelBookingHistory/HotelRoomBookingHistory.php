<?php

namespace Domain\Hotel\HotelBookingHistory;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

// TODO: todo
/**
 * @ORM\Entity
 */
class HotelRoomBookingHistory
{

    private string $hotelRoomId;

    /**
     * @var array<HotelRoomBooking>
     */
    private array $bookings;

    public function add(DateTime $eventCreationDateTime, string $tenantId, array $days)
    {


    }

}