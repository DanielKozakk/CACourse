<?php


namespace App\Domain\Hotel;


interface HotelRepository
{
    function save(Hotel $hotel);
    function findById(string $id) : ?Hotel;
}