<?php

namespace App\Domain\HotelBookingHistory;


use App\Domain\HotelRoom\HotelRoom;
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

    public function add(string $hotelRoomId, DateTime $bookingDateTime, string $tenantId, DateTime $startDate, DateTime $endDate ): self
    {
        $hotelRoomBookingHistory = $this->findHotelRoomBookingHistoryFor($hotelRoomId);

    }



    private function findHotelRoomBookingHistoryFor(string $hotelRoomId){

        $hotelRoomBookingHistory = null ;
        foreach($this->hotelRoomBookingHistories as $hotelRoomHistory){
            if($hotelRoomHistory->getHotelRoomId() === $hotelRoomId){
                $hotelRoomBookingHistory =  $hotelRoomHistory;
            }
        }

        if(!$hotelRoomHistory){
            $hotelRoomHistory = new HotelRoomBookingHistory($hotelRoomId);
        }

        return $hotelRoomHistory;
    }

}
