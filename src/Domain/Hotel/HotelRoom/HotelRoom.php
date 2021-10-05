<?php

namespace Domain\Hotel\HotelRoom;

use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\ManyToOne(targetEntity="\Domain\Hotel\Hotel", orphanRemoval=true)
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id")
     */
    private int $hotelId;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $hotelRoomNumber;

//    /**
//     * @var array<string, float> $spaces
//     * @ORM\OneToMany(targetEntity="Space", mappedBy="hotelRoom")
//     *
//     */
//    private array $spaces;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $description;

    public function __construct(int $hotelId, int $hotelRoomNumber,
//                                array $spaces,
                                string $description)
    {
        $this->hotelId = $hotelId;
        $this->hotelRoomNumber = $hotelRoomNumber;
//        $this->spaces = $spaces;
        $this->description = $description;
    }

//    public function book(int $tenantId, array $days, EventChannel $eventChannel): Booking{
//
//        $hotelRoomBookedEvent = HotelRoomBookedEvent::create($this->id, $this->hotelId, $tenantId, $days);
//        $eventChannel->publishHotelRoomBookedEvent($hotelRoomBookedEvent);
//
//        return Booking::bookHotelRoom($this->id, $tenantId, $days);
//    }
}