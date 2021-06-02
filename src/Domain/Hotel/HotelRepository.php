<?php


namespace App\Domain\Hotel;


interface HotelRepository
{
    function save(Hotel $hotel);
}