<?php


namespace App\Domain\Apartment;


class SquareMeter
{
    /**
     * @var float
     */
    private $size;

    /**
     * SquareMeter constructor.
     * @param double $size
     */
    public function __construct(float $size)
    {
        $this->size = $size;
    }
}