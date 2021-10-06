<?php

namespace Domain\Apartment;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\PersistentCollection;
use Domain\EventChannel\EventChannel;

//use Domain\EventChannel\EventChannel;

/**
 * @ORM\Entity(repositoryClass="\Infrastructure\Persistence\Doctrine\Apartment\SqlDoctrineApartmentRepository")
 * @ORM\Table(name="apartment")
 */
class Apartment
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private string $ownerId;
    /**
     * @var ApartmentAddress
     *  @Embedded(class="ApartmentAddress")
     */
    private ApartmentAddress $address;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $description;

    /**
     * @ORM\OneToMany(targetEntity="Room", mappedBy="apartment", cascade={"persist", "remove"}, orphanRemoval=true)
     * @var ArrayCollection|array<Room>|PersistentCollection $rooms
     */
    protected array|PersistentCollection|ArrayCollection $rooms;

    public function __construct(string           $ownerId,
                                ApartmentAddress $address,
                                string           $description
    )
    {
        $this->ownerId = $ownerId;
        $this->address = $address;
        $this->description = $description;
        $this->rooms = new ArrayCollection();
    }
    public function addRoom(Room $room){
        $this->rooms[] = $room;
    }

    public function book(string $tenantId, Period $period, EventChannel $eventChannel) : Booking{
        // publish event
        $apartmentBooked = ApartmentBookedEvent::create($this->id, $this->ownerId, $tenantId, $period->getStartDate(), $period->getEndDate());
        $eventChannel->publishApartmentBookedEvent($apartmentBooked);

        return Booking::bookApartment($this->id, $tenantId, $period);
    }
}