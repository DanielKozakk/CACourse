<?php

namespace Domain\Apartment;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;

/**
 * @ORM\Entity(repositoryClass="\Infrastructure\Persistence\Doctrine\Apartment\SqlDoctrineApartmentRepository")
 */
class Apartment
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $ownerId;
    /**
     * @var ApartmentAddress
     *  @Embedded(class = "ApartmentAddress")
     */
    private $address;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Room", mappedBy="apartment")
     * @var array<Room> $rooms
     */
    private $rooms;

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

    public function book(string $tenantId, Period $period){
        // publish event
        $apartmentBooked = new ApartmentBooked($this->id, $this->ownerId, $tenantId, $period);
    }
}