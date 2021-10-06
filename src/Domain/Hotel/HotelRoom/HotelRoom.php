<?php

namespace Domain\Hotel\HotelRoom;

use DeepCopy\Filter\Doctrine\DoctrineCollectionFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Domain\Apartment\Booking;
use Domain\EventChannel\EventChannel;
use Domain\Hotel\Hotel;

//use Domain\Apartment\Booking;
//use Domain\EventChannel\EventChannel;

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
     *
     * @ORM\ManyToOne(targetEntity="\Domain\Hotel\Hotel")
     *
     */
    private $hotel;
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

        $hotelRoomBookedEvent = HotelRoomBookedEvent::create($this->id, $this->hotelId, $tenantId, $days);
        $eventChannel->publishHotelRoomBookedEvent($hotelRoomBookedEvent);

        return Booking::bookHotelRoom($this->id, $tenantId, $days);
    }


}