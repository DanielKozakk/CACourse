<?php

namespace Domain\Hotel\HotelRoom;

class SquareMeter
{
    private float $size;

    public function __construct(float $size)
    {
        $this->size = $size;
    }
}