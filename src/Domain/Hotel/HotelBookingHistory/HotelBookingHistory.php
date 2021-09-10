<?php

namespace Domain\Hotel\HotelBookingHistory;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * //TODO: todo
 * @ORM\Entity (repositoryClass="")
 */
class HotelBookingHistory
{

    /**
     * @var string
     * @ORM\Id
     */
    private string $hotelId;

    /**
     * @var array<HotelRoomBookingHistory>|ArrayCollection
     * one to many
     */
    private array|ArrayCollection $hotelRoomBookingHistories;

    /**
     * @param string $hotelId
     */
    public function __construct(string $hotelId )
    {
        $this->hotelId = $hotelId;
        $this->hotelRoomBookingHistories = new ArrayCollection();
    }


    public function add (string $hotelRoomId, DateTime $eventCreationDateTime, string $tenantId, array $days){

    }
}