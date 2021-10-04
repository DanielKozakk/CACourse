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
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected int $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected string $ownerId;
    /**
     * @var string
     * @ORM\Column(type="string", name="address_street", length=255)
     */
    protected string $street;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected string $postalCode;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected string $houseNumber;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected string $apartmentNumber;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected string $city;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected string $country;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected string $description;

//    /**
//     * @ORM\OneToMany(targetEntity="Room", mappedBy="apartment")
//     * @var array<RoomReadModel> $rooms
//     */
//    private array $rooms;

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
    public function __construct(string $ownerId,
                                string $street,
                                string $postalCode,
                                string $houseNumber,
                                string $apartmentNumber,
                                string $city,
                                string $country,
                                string $description)
    {
        $this->ownerId = $ownerId;
        $this->address_street = $street;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->apartmentNumber = $apartmentNumber;
        $this->city = $city;
        $this->country = $country;
        $this->description = $description;
    }


}