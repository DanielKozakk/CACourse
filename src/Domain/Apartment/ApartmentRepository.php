<?php

namespace Domain\Apartment;

interface ApartmentRepository
{
    public function save(Apartment $apartment);

}