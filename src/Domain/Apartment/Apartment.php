<?php

namespace Domain\Apartment;

class Apartment
{
    /**
     * @var string
     */
    private $ownerId;
    /**
     * @var Address
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

    public function __construct(string  $ownerId,
                                Address $address,
                                string  $description,
                                array   $rooms)
    {
        $this->ownerId = $ownerId;
        $this->address = $address;
        $this->description = $description;
        $this->rooms = $rooms;
    }
}