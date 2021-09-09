<?php

namespace Domain\Hotel\HotelRoom;

use Doctrine\ORM\Mapping as ORM;
use Domain\EventChannel\EventChannel;

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
     * @var string
     * @ORM\Column(type="string")
     */
    private string $hotelId;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $hotelRoomNumber;

    /**
     * @var array<string, float> $spaces
     * @ORM\OneToMany(targetEntity="Space", mappedBy="hotelRoom")
     *
     */
    private array $spaces;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $description;

    public function __construct(string $hotelId, int $hotelRoomNumber, array $spaces, string $description)
    {
        $this->hotelId = $hotelId;
        $this->hotelRoomNumber = $hotelRoomNumber;
        $this->spaces = $spaces;
        $this->description = $description;
    }

    public function book(int $tenantId, array $days, EventChannel $eventChannel){

        $hotelRoomBookedEvent = HotelRoomBookedEvent::create($this->id, $this->hotelId, $tenantId, $days);
        $eventChannel->publishHotelRoomBookedEvent($hotelRoomBookedEvent);

    }
}