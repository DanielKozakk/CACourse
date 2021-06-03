<?php


namespace App\Domain\Apartment;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * Class Apartment
 * @package App\Domain\Apartment
 *
 * @Entity(repositoryClass="App\Infrastructure\Persistance\Doctrine\Apartment\DoctrineSqlApartmentRepository")
 */
class Apartment
{
    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var string
     */
    private $ownerId;
    /**
     * @var Address
     *
     * @ORM\Embedded(class="Address")
     */
    private $address;
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="apartment")
     */
    private $rooms;
    /**
     * Apartment constructor.
     * @param string $ownerId
     * @param Address $address
     * @param string $description
     */
    public function __construct(string $ownerId, \App\Domain\Apartment\Address $address,array $rooms, string $description)
    {
        $this->ownerId = $ownerId;
        $this->address = $address;
        $this->description = $description;
        $this->rooms = $rooms;
    }

    public function book(string $tenantId, Period $period)
    {

    }
}