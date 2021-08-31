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

    public function __construct(string $ownerId, Address $address, string $description)
    {
        $this->ownerId = $ownerId;
        $this->address = $address;
        $this->description = $description;
    }
}