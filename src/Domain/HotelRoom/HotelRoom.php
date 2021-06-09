<?php


namespace App\Domain\HotelRoom;


use App\Domain\Event\EventChannel;
use App\Domain\Hotel\Hotel;

use App\Domain\HotelBookingHistory\HotelBookingHistory;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity(repositoryClass="App\Infrastructure\Persistance\Doctrine\HotelRoom\DoctrineSqlHotelRoomRepository")
 */
class HotelRoom
{
    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @var Space[]
     * @ORM\OneToMany(targetEntity="Space", mappedBy="hotelRoom")
     */
    private $spacesDefinition;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="HotelBookingHistory", mappedBy="hotelRoomId", cascade={"persist", "remove"})
     */
    private ?HotelBookingHistory $hotelBookingHistory;

    /**
     * @var Hotel
     * @ORM\ManyToOne(targetEntity=Hotel::class, inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private Hotel $hotel;

    /**
     * HotelRoom constructor.
     * @param int $number
     * @param Space[] $spacesDefinition
     * @param string $description
     * @param Hotel $hotel
     */
    public function __construct(int $number, array $spacesDefinition, string $description, Hotel $hotel)
    {
        $this->hotel = $hotel;
        $this->number = $number;
        $this->spacesDefinition = $spacesDefinition;
        $this->description = $description;
    }

    public function book($tenantId, Period $period, EventChannel $eventChannel)
    {
        $eventChannel->publishHotelRoomBooked(HotelBookedEvent::create($this->id, $this->hotel->getId(), $tenantId, $period));
    }

    public function getHotelBookingHistory(): ?HotelBookingHistory
    {
        return $this->hotelBookingHistory;
    }

    public function setHotelBookingHistory(HotelBookingHistory $hotelBookingHistory): self
    {
        // set the owning side of the relation if necessary
        if ($hotelBookingHistory->getHotelRoomId() !== $this) {
            $hotelBookingHistory->setHotelRoomId($this);
        }

        $this->hotelBookingHistory = $hotelBookingHistory;

        return $this;
    }
}