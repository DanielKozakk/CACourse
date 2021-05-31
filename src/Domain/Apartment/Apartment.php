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
     * Apartment constructor.
     * @param string $ownerId
     * @param Address $address
     * @param string $description
     */
    public function __construct(string $ownerId, \App\Domain\Apartment\Address $address, string $description)
    {
        $this->ownerId = $ownerId;
        $this->address = $address;
        $this->description = $description;
    }
}