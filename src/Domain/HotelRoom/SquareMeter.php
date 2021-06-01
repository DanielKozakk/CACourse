<?php


namespace App\Domain\HotelRoom;


class SquareMeter
{

    /**
     * @var float
     */
    private $size;

    /**
     * SquareMeter constructor.
     * @param float $size
     */
    public function __construct(float $size)
    {
        $this->size = $size;
    }

}