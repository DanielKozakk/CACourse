<?php

namespace Domain\Hotel\HotelRoom;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Domain\Apartment\Booking;
use Domain\EventChannel\EventChannel;
use Domain\Hotel\Hotel;

/**
 * @ORM\Entity(repositoryClass="Infrastructure\Persistence\Doctrine\Hotel\HotelRoom\SqlDoctrineHotelRoomRepository")
 */
class HotelRoom
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Domain\Hotel\Hotel")
     */
    private Hotel $hotel;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $hotelRoomNumber;

    /**
     * @var array<string, float>|ArrayCollection|PersistentCollection $spaces
     * @ORM\OneToMany(targetEntity="Space", mappedBy="hotelRoom", cascade={"persist", "remove"})
     *
     */
    private $spaces;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $description;

    public function __construct(Hotel $hotel, int $hotelRoomNumber,
                                string $description)
    {
        $this->hotel = $hotel;
        $this->hotelRoomNumber = $hotelRoomNumber;
        $this->spaces = new ArrayCollection();
        $this->description = $description;
    }

    public function addSpacesToHotelRoom(Space $space){
        $this->spaces[] = $space;
    }

    public function book(int $tenantId, array $days, EventChannel $eventChannel): Booking{

        $hotelRoomBookedEvent = HotelRoomBookedEvent::create($this->id, $this->hotel->getId(), $tenantId, $days);
        $eventChannel->publishHotelRoomBookedEvent($hotelRoomBookedEvent);
        return Booking::bookHotelRoom($this->id, $tenantId, $days);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getHotelRoomNumber(): int
    {
        return $this->hotelRoomNumber;
    }
}