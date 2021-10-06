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
    private array|ArrayCollection $bookings;


    public function __construct(HotelRoom $hotelRoom)
    {
        $this->hotelRoom = $hotelRoom;
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
     * @param string $comparisonId
     * @return bool
     */
    public function hasIdEqualTo(string $comparisonId): bool
    {
        return $comparisonId === $this->hotelRoomId;
    }

}