<?php


namespace App\Domain\Apartment;


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
     * @var Room[]
     */
    private $rooms;

    /**
     * Apartment constructor.
     * @param string $ownerId
     * @param Address $address
     * @param string $description
     */
    public function __construct(string $ownerId, \App\Domain\Apartment\Address $address,array $rooms, string $description)
    {
        $this->ownerId = $ownerId;
        $this->address = $address;
        $this->description = $description;
        $this->rooms = $rooms;
    }
}