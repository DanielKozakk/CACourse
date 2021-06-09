<?php

namespace App\Domain\HotelBookingHistory;


use DateTime;
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
     * @ORM\OneToMany(targetEntity="HotelRoomBookingHistory")
     */
    private ArrayCollection $hotelRoomBookingHistories;

    /**
     * HotelRoomBookingHistory constructor.
     */
    public function __construct()
    {
        $this->hotelRoomBookingHistories = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection
     */
    public function getHotelRoomBookingHistories(): Collection
    {
        return $this->hotelRoomBookingHistories;
    }

    public function add(string $hotelRoomId, DateTime $bookingDateTime, string $tenantId, DateTime $startDate, DateTime $endDate)
    {
        $hotelRoomBookingHistory = $this->findHotelRoomBookingHistoryFor($hotelRoomId);

        $hotelRoomBookingHistory->add($bookingDateTime, $tenantId, $startDate, $endDate);
    }

    private function findHotelRoomBookingHistoryFor(string $hotelRoomId): HotelRoomBookingHistory{
        foreach ($this->hotelRoomBookingHistories as $hotelRoomHistory) {
            if ($hotelRoomHistory->getHotelRoomId() === $hotelRoomId) {
                $hotelRoomBookingHistory = $hotelRoomHistory;
            }
        }

        $hotelRoomBookingHistory ??= new HotelRoomBookingHistory($hotelRoomId);

        return $hotelRoomBookingHistory;
    }

}
