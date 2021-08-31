<?php

namespace Domain\Apartment;

class Room
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var SquareMeter
     */
    private $squareMeter;

    public function __construct(string $name, SquareMeter $squareMeter)
    {
        $this->name = $name;
        $this->squareMeter = $squareMeter;
    }
}