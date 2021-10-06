<?php

namespace Domain\Hotel\HotelBookingHistory;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Domain\Hotel\HotelRoom\HotelRoom;


/**
 * @ORM\Entity
 */
class HotelRoomBookingHistory
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column (type="integer")
     */
    private int $id;

    /**
     * @ORM\OneToOne(targetEntity="Domain\Hotel\HotelRoom\HotelRoom")
     */
    private $hotelRoom;

    /**
     * @var HotelBookingHistory
     * @ORM\ManyToOne(targetEntity="HotelBookingHistory", inversedBy="hotelRoomBookingHistories")
     */
    private HotelBookingHistory $hotelBookingHistory;

    /**
     * @var array<HotelRoomBooking>|ArrayCollection
     * @ORM\OneToMany(targetEntity="HotelRoomBooking", mappedBy="hotelRoomBookingHistory", cascade={"persist", "remove"})
     */
    private $bookings;


    public function __construct(HotelRoom $hotelRoom, HotelBookingHistory $hotelBookingHistory)
    {
        $this->hotelRoom = $hotelRoom;
        $this->hotelBookingHistory = $hotelBookingHistory;
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
        //TODO : prawdopodobnie potrzebny jest zapis do bazy danych tutaj albo w HotelBookingHistory::add
    }

    /**
     * @param HotelRoom $hotelRoom
     * @return bool
     */
    public function hasHotelRoomEqualTo(HotelRoom $hotelRoom): bool
    {
        return $hotelRoom == $this->hotelRoom;
    }

}