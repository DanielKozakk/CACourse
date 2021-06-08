<?php

namespace App\Entity;

use App\Repository\HotelRoomFakeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HotelRoomFakeRepository::class)
 */
class HotelRoomFake
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
    private $ebc;

    /**
     * @ORM\OneToOne(targetEntity=HotelRoomBookingHistory::class, mappedBy="hotelRoomId", cascade={"persist", "remove"})
     */
    private $hotelRoomBookingHistory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEbc(): ?string
    {
        return $this->ebc;
    }

    public function setEbc(string $ebc): self
    {
        $this->ebc = $ebc;

        return $this;
    }

    public function getHotelRoomBookingHistory(): ?HotelRoomBookingHistory
    {
        return $this->hotelRoomBookingHistory;
    }

    public function setHotelRoomBookingHistory(HotelRoomBookingHistory $hotelRoomBookingHistory): self
    {
        // set the owning side of the relation if necessary
        if ($hotelRoomBookingHistory->getHotelRoomId() !== $this) {
            $hotelRoomBookingHistory->setHotelRoomId($this);
        }

        $this->hotelRoomBookingHistory = $hotelRoomBookingHistory;

        return $this;
    }
}
