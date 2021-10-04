<?php

namespace Query\Apartment;

use Doctrine\ORM\Mapping as ORM;
use Domain\Apartment\Apartment;

/**
 * @ORM\Entity(repositoryClass="\Query\Apartment\SqlDoctrineQueryApartmentReadModelRepository")
 * TODO: use Single Table Inheritance to connect with apartment table instead of apartment_read_model
 *
 */
class ApartmentReadModel extends Apartment
{

//    /**
//     * @ORM\OneToMany(targetEntity="Room", mappedBy="apartment")
//     * @var array<RoomReadModel> $rooms
//     */
//    private array $rooms;


}