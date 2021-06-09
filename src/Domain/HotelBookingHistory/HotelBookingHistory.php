<?php

namespace App\Domain\HotelBookingHistory;


use App\Domain\HotelRoom\HotelRoom;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class HotelBookingHistory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="HotelBooking", mappedBy="hotelRoomBookingHistory", orphanRemoval=true)
     */
    private ArrayCollection $bookings;

    /**
     * @ORM\OneToOne(targetEntity="HotelRoom" inversedBy="hotelBookingHistory", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private mixed $hotelRoomId;

    /**
     * HotelRoomBookingHistory constructor.
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
     * @return Collection
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function add(HotelBooking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setHotelBookingHistory($this);
        }

        return $this;
    }

    public function removeBooking(HotelBooking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getHotelBookingHistory() === $this) {
                $booking->setHotelBookingHistory(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHotelRoomId(): mixed
    {
        return $this->hotelRoomId;
    }

    /**
     * @param mixed $hotelRoomId
     */
    public function setHotelRoomId($hotelRoomId): void
    {
        $this->hotelRoomId = $hotelRoomId;
    }


}
