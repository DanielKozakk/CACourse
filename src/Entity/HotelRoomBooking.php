<?php

namespace App\Entity;

use App\Repository\HotelRoomBookingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HotelRoomBookingRepository::class)
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
     * @ORM\Embedded
     */
    private HotelRoomBookingPeriod $hotelRoomBookingPeriod;

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
}
