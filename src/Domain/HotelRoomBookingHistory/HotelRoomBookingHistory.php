<?php

namespace App\Domain\HotelRoomBookingHistory;


use App\Domain\HotelRoom\HotelRoom;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity=HotelRoomBooking, mappedBy="hotelRoomBookingHistory", orphanRemoval=true)
     */
    private $bookings;

    /**
     * @ORM\OneToOne(targetEntity=HotelRoom inversedBy="hotelRoomBookingHistory", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotelRoomId;

    /**
     * HotelRoomBookingHistory constructor.
     * @param $bookings
     * @param $hotelRoomId
     */
    public function __construct()
    {
        $this->bookings = new ArrayCollection();

    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|HotelRoomBooking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function add(HotelRoomBooking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setHotelRoomBookingHistory($this);
        }

        return $this;
    }

    public function removeBooking(HotelRoomBooking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getHotelRoomBookingHistory() === $this) {
                $booking->setHotelRoomBookingHistory(null);
            }
        }

        return $this;
    }

}
