<?php

namespace Domain\Apartment;

interface ApartmentRepository
{
    public function save(Apartment $apartment): int;

    public function findById(int $apartmentId): Apartment;

}