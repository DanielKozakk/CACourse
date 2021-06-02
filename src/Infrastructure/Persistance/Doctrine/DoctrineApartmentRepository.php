<?php


namespace App\Infrastructure\Persistance\Doctrine;


use App\Domain\Apartment\Apartment;
use App\Domain\Apartment\ApartmentRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineApartmentRepository extends ServiceEntityRepository implements ApartmentRepository
{


    function save(Apartment $apartment)
    {

    }
}