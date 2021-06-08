<?php


namespace App\Domain\ApartmentBookingHistory;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ApartmentBookingHistory
{

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     */
    private string $apartmentId;

    /**
     * @ORM\OneToMany(targetEntity=ApartmentBooking::class, mappedBy="apartmentBookingHistory")
     */
    private $bookings;

    public function __construct(string $apartmentId)
    {
        $this->bookings = new ArrayCollection();
        $this->apartmentId = $apartmentId;
    }

    public function getId(): ?int
    {
        return $this->apartmentId;
    }

    public function getApartmentId(): ?string
    {
        return $this->apartmentId;
    }

    public function setApartmentId(string $apartmentId): self
    {
        $this->apartmentId = $apartmentId;

        return $this;
    }

    /**
     * @return Collection|ApartmentBooking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function removeBooking(ApartmentBooking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getApartmentBookingHistory() === $this) {
                $booking->setApartmentBookingHistory(null);
            }
        }

        return $this;
    }

    public function add(ApartmentBooking $booking) : self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setApartmentBookingHistory($this);
        }

        return $this;
    }
}
