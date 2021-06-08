<?php

namespace App\Domain\HotelRoomBookingHistory;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class HotelRoomBooking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $hotelRoomBookingCreationDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tenantId;


    /**
     * @ORM\Embedded(class = "HotelRoomBookingPeriod")
     */
    private HotelRoomBookingPeriod $hotelRoomBookingPeriod;

    /**
     * @ORM\ManyToOne(targetEntity=HotelRoomBookingHistory::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotelRoomBookingHistory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHotelRoomBookingCreationDate(): ?\DateTimeInterface
    {
        return $this->hotelRoomBookingCreationDate;
    }

    public function setHotelRoomBookingCreationDate(\DateTimeInterface $hotelRoomBookingCreationDate): self
    {
        $this->hotelRoomBookingCreationDate = $hotelRoomBookingCreationDate;

        return $this;
    }

    public function getTenantId(): ?string
    {
        return $this->tenantId;
    }

    public function setTenantId(string $tenantId): self
    {
        $this->tenantId = $tenantId;

        return $this;
    }

    public function getHotelRoomBookingHistory(): ?HotelRoomBookingHistory
    {
        return $this->hotelRoomBookingHistory;
    }

    public function setHotelRoomBookingHistory(?HotelRoomBookingHistory $hotelRoomBookingHistory): self
    {
        $this->hotelRoomBookingHistory = $hotelRoomBookingHistory;

        return $this;
    }
}
