<?php

namespace Domain\Apartment;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\PersistentCollection;
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
    protected int $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected string $ownerId;
    /**
     * @var ApartmentAddress
     *  @Embedded(class="ApartmentAddress")
     */
    protected ApartmentAddress $address;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected string $description;

//    /**
//     * @ORM\OneToMany(targetEntity="Room", mappedBy="apartment")
//     * @var ArrayCollection|array<Room>|PersistentCollection $rooms
//     */
//    protected $rooms;

    public function __construct(string           $ownerId,
                                ApartmentAddress $address,
                                string           $description,
                                array $rooms
    )
    {
        $this->ownerId = $ownerId;
        $this->address = $address;
        $this->description = $description;
        $this->rooms = $rooms;
    }

//    public function book(string $tenantId, Period $period, EventChannel $eventChannel) : Booking{
//        // publish event
//        $apartmentBooked = ApartmentBookedEvent::create($this->id, $this->ownerId, $tenantId, $period->getStartDate(), $period->getEndDate());
//        $eventChannel->publishApartmentBookedEvent($apartmentBooked);
//
//        return Booking::bookApartment($this->id, $tenantId, $period);
//    }
}