<?php


namespace App\Domain\Apartment;


interface ApartmentRepository
{
    /**
     * @param Apartment $apartment
     * @return mixed
     */
    function save(Apartment $apartment);
}