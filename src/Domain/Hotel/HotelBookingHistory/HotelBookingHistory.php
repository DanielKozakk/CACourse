<?php

namespace Domain\Hotel\HotelBookingHistory;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ ORM\Entity (repositoryClass="")
 */
class HotelBookingHistory
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column (type="integer")
     */
    private int $hotelId;

    /**
     * @var array<HotelRoomBookingHistory>|ArrayCollection
     * @ORM\OneToMany(targetEntity="HotelRoomBookingHistory")
     */
    private array|ArrayCollection $hotelRoomBookingHistories;

    /**
     * @param int $hotelId
     */
    public function __construct(int $hotelId)
    {
        $this->hotelId = $hotelId;
        $this->hotelRoomBookingHistories = new ArrayCollection();
    }

    /**
     * @param string $hotelRoomId
     * @param DateTime $bookingDateTime
     * @param string $tenantId
     * @param array<DateTime> $days
     */
    public function add(string $hotelRoomId, DateTime $bookingDateTime, string $tenantId, array $days)
    {
        $hotelRoomBookingHistory = $this->findFor($hotelRoomId);

        $hotelRoomBookingHistory->add($bookingDateTime, $tenantId, $days);
    }

    private function findFor(string $hotelRoomId) : HotelRoomBookingHistory
    {
        /**
         * @var array<HotelRoomBooking>
         */
        $history = array_filter($this->hotelRoomBookingHistories, function (HotelRoomBookingHistory $hotelRoomBookingHistory) use ($hotelRoomId) {
            return $hotelRoomBookingHistory->hasIdEqualTo($hotelRoomId);
        });

        if(empty($history)){

            $hotelRoomBookingHistory = new HotelRoomBookingHistory($hotelRoomId);
            $this->hotelRoomBookingHistories->add($hotelRoomBookingHistory);
            return $hotelRoomBookingHistory;
        } else {
            return $history->first();
        }
    }

}