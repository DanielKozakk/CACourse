<?php

namespace Domain\Hotel\HotelBookingHistory;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Domain\Hotel\Hotel;
use Domain\Hotel\HotelRoom\HotelRoom;

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
     * @ORM\GeneratedValue
     * @ORM\Column (type="integer")
     */
    private int $id;

    /**
     *
     * @ORM\OneToOne(targetEntity="Domain\Hotel\Hotel")
     */
    private $hotel;

    /**
     * @var array<HotelRoomBookingHistory>|ArrayCollection
     * @ORM\OneToMany(targetEntity="HotelRoomBookingHistory", mappedBy="hotelBookingHistory", cascade={"persist", "remove"})
     */
    private array|ArrayCollection $hotelRoomBookingHistories;

    /**
     * @param Hotel $hotel
     */
    public function __construct(Hotel $hotel)
    {
        $this->hotel = $hotel;
        $this->hotelRoomBookingHistories = new ArrayCollection();
    }

    /**
     * @param HotelRoom $hotelRoom
     * @param DateTime $bookingDateTime
     * @param string $tenantId
     * @param array<DateTime> $days
     */
    public function add(HotelRoom $hotelRoom, DateTime $bookingDateTime, string $tenantId, array $days)
    {
        $hotelRoomBookingHistory = $this->findFor($hotelRoom);

        $hotelRoomBookingHistory->add($bookingDateTime, $tenantId, $days);
    }

    private function findFor(HotelRoom $hotelRoom): HotelRoomBookingHistory
    {
        /**
         * @var array<HotelRoomBooking>
         */
        $history = array_filter($this->hotelRoomBookingHistories, function (HotelRoomBookingHistory $hotelRoomBookingHistory) use ($hotelRoom) {
            return $hotelRoomBookingHistory->hasHotelRoomEqualTo($hotelRoom);
        });

        if (empty($history)) {

            $hotelRoomBookingHistory = new HotelRoomBookingHistory($hotelRoom, $this);
            $this->hotelRoomBookingHistories->add($hotelRoomBookingHistory);
            return $hotelRoomBookingHistory;
        } else {
            return $history->first();
        }
    }

}