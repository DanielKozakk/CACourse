<?php

namespace Domain\Apartment;

interface ApartmentRepository
{
    public function save(Apartment $apartment);

    public function findById(int $apartmentId): Apartment;

}