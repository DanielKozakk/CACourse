<?php


namespace App\Domain\HotelRoom;

use App\Domain\Apartment\EventChannel;
use App\Domain\Hotel\Hotel;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 *  @Entity(repositoryClass="App\Infrastructure\Persistance\Doctrine\HotelRoom\DoctrineSqlHotelRoomRepository")
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
     * @var Hotel
     * @ORM\ManyToOne(targetEntity=Hotel::class, inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotel;

    /**
     * HotelRoom constructor.
     * @param int $number
     * @param Space[] $spacesDefinition
     * @param string $description
     */
    public function __construct( int $number, array $spacesDefinition, string $description, Hotel $hotel)
    {
        $this->hotel = $hotel;
        $this->number = $number;
        $this->spacesDefinition = $spacesDefinition;
        $this->description = $description;
    }

    public function book($tenantId, Period $period, EventChannel $eventChannel){
        $eventChannel->publishHotelRoomBooked(HotelRoomBookedEvent::create($this->id, $this->hotel->getId(), $tenantId, $period));
    }

}