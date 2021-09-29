<?php

namespace Domain\Apartment;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use Domain\EventChannel\EventChannel;

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
     *  @Embedded(class = "ApartmentAddress")
     */
    private ApartmentAddress $address;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $description;

    /**
     * @ORM\OneToMany(targetEntity="Room", mappedBy="apartment")
     * @var array<Room> $rooms
     */
    private array $rooms;

    public function __construct(string           $ownerId,
                                ApartmentAddress $address,
                                string           $description,
                                array            $rooms)
    {
        $this->ownerId = $ownerId;
        $this->address = $address;
        $this->description = $description;
        $this->rooms = $rooms;
    }

    public function book(string $tenantId, Period $period, EventChannel $eventChannel) : Booking{
        // publish event
        $apartmentBooked = ApartmentBookedEvent::create($this->id, $this->ownerId, $tenantId, $period->getStartDate(), $period->getEndDate());
        $eventChannel->publishApartmentBookedEvent($apartmentBooked);

        return Booking::bookApartment($this->id, $tenantId, $period);
    }
}