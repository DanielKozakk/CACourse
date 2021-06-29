<?php


namespace App\Domain\Apartment;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;

interface ApartmentRepository
{
    /**
     * @param Apartment $apartment
     * @return mixed
     */
    function save(Apartment $apartment);

    public function findById(string $id) : Apartment;
}