<?php

namespace Domain\Apartment;

use Doctrine\ORM\Mapping as ORM;

// TODO: jeśli Repo nie działa to prawdopodobnie dlatego
/**
 * @ORM\Entity(repositoryClass=\Infrastructure\Persistence\Doctrine\Apartment\SqlDoctrineApartmentRepository)
 */
class Apartment
{
    /**
     * @var string
     */
    private $ownerId;
    /**
     * @var ApartmentAddress
     */
    private $address;
    /**
     * @var string
     */
    private $description;

    /**
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
}