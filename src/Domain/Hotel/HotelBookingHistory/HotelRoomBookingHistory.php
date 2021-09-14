<?php

namespace Domain\Hotel\HotelBookingHistory;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

// TODO: todo
/**
 * @ORM\Entity
 */
class HotelRoomBookingHistory
{

    /**
     * @var string
     * @ORM\Id
     */
    private string $hotelRoomId;

    /**
     * @var array<HotelRoomBooking>|ArrayCollection
     */
    private array|ArrayCollection $bookings;

    /**
     * @param string $hotelRoomId
     * TODO: OneToMany
     */
    public function __construct(string $hotelRoomId)
    {
        $this->hotelRoomId = $hotelRoomId;
        $this->bookings = new ArrayCollection();
    }


    /**
     * @param DateTime $eventCreationDateTime
     * @param string $tenantId
     * @param array<DateTime> $days
     */
    public function add(DateTime $eventCreationDateTime, string $tenantId, array $days)
    {
        $this->bookings->add(new HotelRoomBooking)
    }

    /**
     * @param string $comparisonId
     * @return bool
     */
    public function hasIdEqualTo(string $comparisonId): bool
    {
        return $comparisonId === $this->hotelRoomId;
    }

}