<?php


namespace App\Domain\Apartment;


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

    /**
     * Room constructor.
     * @param string $name
     * @param SquareMeter $squareMeter
     */
    public function __construct(string $name, SquareMeter $squareMeter)
    {
        $this->name = $name;
        $this->squareMeter = $squareMeter;
    }


}