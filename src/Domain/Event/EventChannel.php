<?php


namespace App\Domain\Apartment;


interface EventChannel
{

    public function publish(ApartmentBooked $apartmentBooked);


}