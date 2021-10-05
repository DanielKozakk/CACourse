<?php

namespace Domain\Hotel;

interface HotelRepository
{
    public function save(Hotel $hotel) : void;

}