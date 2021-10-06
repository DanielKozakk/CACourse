<?php

namespace Domain\Hotel;

interface HotelRepository
{
    public function save(Hotel $hotel) : void;
    public function findById(int $id): ?Hotel;

}