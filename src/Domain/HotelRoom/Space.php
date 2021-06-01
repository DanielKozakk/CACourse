<?php


namespace App\Domain\HotelRoom;


class Space
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var SquareMeter
     */
    private $squareMeter;

    /**
     * Space constructor.
     * @param string $name
     * @param SquareMeter $squareMeter
     */
    public function __construct(string $name, SquareMeter $squareMeter)
    {
        $this->name = $name;
        $this->squareMeter = $squareMeter;
    }
}