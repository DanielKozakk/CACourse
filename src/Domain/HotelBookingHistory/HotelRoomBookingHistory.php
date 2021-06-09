<?php


namespace App\Domain\HotelBookingHistory;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class HotelRoomBookingHistory
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="HotelRoomBooking", mappedBy="$hotelBookingHistory")
     */
    private $bookings;

    /**
     * @ORM\Column(type="string")
     */
    private string $hotelRoomId;

    /**
     * HotelRoomBookingHistory constructor.
     * @param string $hotelRoomId
     */
    public function __construct(string $hotelRoomId)
    {

        $this->hotelRoomId = $hotelRoomId;
    }


    public function add(DateTime $bookingDateTime,
                        string $tenantId,
                        DateTime $startDate,
                        DateTime $endDate){

        $this->bookings[] = new HotelRoomBooking($bookingDateTime, $tenantId, $startDate, $endDate);

    }

    public function hasIdEqualTo(String $hotelRoomId){
        return $hotelRoomId === $this->getHotelRoomId();
    }

    /**
     * @param mixed $bookings
     */
    public function setBookings($bookings): void
    {
        $this->bookings = $bookings;
    }

    /**
     * @return string
     */
    public function getHotelRoomId(): string
    {
        return $this->hotelRoomId;
    }


}