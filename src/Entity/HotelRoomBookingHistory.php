<?php

namespace App\Entity;

use App\Repository\HotelRoomBookingHistoryRepository;
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
     * @ORM\OneToMany(targetEntity=HotelRoomBooking::class, mappedBy="hotelRoomBookingHistory", orphanRemoval=true)
     */
    private $bookings;

    /**
     * @ORM\OneToOne(targetEntity=HotelRoomFake::class, inversedBy="hotelRoomBookingHistory", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotelRoomId;

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

    public function addBooking(HotelRoomBooking $booking): self
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

    public function getHotelRoomId(): ?HotelRoomFake
    {
        return $this->hotelRoomId;
    }

    public function setHotelRoomId(HotelRoomFake $hotelRoomId): self
    {
        $this->hotelRoomId = $hotelRoomId;

        return $this;
    }
}
