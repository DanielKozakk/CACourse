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
     * TODO: OneToMany
     */
    private array|ArrayCollection $bookings;

    /**
     * @param string $hotelRoomId
     *
     */
    public function __construct(string $hotelRoomId)
    {
        $this->hotelRoomId = $hotelRoomId;
        $this->bookings = new ArrayCollection();
    }


    /**
     * @param DateTime $bookingDateTime
     * @param string $tenantId
     * @param array<DateTime> $days
     */
    public function add(DateTime $bookingDateTime, string $tenantId, array $days)
    {
        $this->bookings->add(new HotelRoomBooking($bookingDateTime, $tenantId, $days));
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