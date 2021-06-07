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
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apartmentId;

    /**
     * @ORM\OneToMany(targetEntity=ApartmentBooking::class, mappedBy="apartmentBookingHistory")
     */
    private $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function addBooking(ApartmentBooking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setApartmentBookingHistory($this);
        }

        return $this;
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
}
