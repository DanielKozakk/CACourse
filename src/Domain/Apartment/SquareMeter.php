<?php

namespace Domain\Apartment;

class SquareMeter
{
    /**
     * @var mixed
     */
    private $size;

    /**
     * @param float|mixed $size
     */
    public function __construct($size)
    {
        $this->size = $size;
    }
}