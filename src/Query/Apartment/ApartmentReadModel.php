<?php

namespace Query\Apartment;

use Doctrine\ORM\Mapping as ORM;
use Domain\Apartment\Room;

/**
 * //TODO: Entity
 * //TODO: Połącz encje z command
 * @ ORM\Entity(repositoryClass="")
 */
class ApartmentReadModel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private string $ownerId;
    /**
     * @var string
     */
    private string $street;
    /**
     * @var string
     */
    private string $postalCode;
    /**
     * @var string
     */
    private string $houseNumber;
    /**
     * @var string
     */
    private string $apartmentNumber;
    /**
     * @var string
     */
    private string $city;
    /**
     * @var string
     */
    private string $country;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $description;

    /**
     * @ORM\OneToMany(targetEntity="Room", mappedBy="apartment")
     * @var array<RoomReadModel> $rooms
     */
    private array $rooms;

    /**
     * @param string $ownerId
     * @param string $street
     * @param string $postalCode
     * @param string $houseNumber
     * @param string $apartmentNumber
     * @param string $city
     * @param string $country
     * @param string $description
     */
    public function __construct(string $ownerId, string $street, string $postalCode, string $houseNumber, string $apartmentNumber, string $city, string $country, string $description)
    {
        $this->ownerId = $ownerId;
        $this->street = $street;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->apartmentNumber = $apartmentNumber;
        $this->city = $city;
        $this->country = $country;
        $this->description = $description;
    }


}