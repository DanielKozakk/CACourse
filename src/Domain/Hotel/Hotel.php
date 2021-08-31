<?php

namespace Domain\Hotel;

class Hotel
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var HotelAddress
     */
    private $address;

    public function __construct(string $name, HotelAddress $address)
    {
        $this->name = $name;
        $this->address = $address;
    }
}