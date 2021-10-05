<?php

namespace Query\Apartment;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\Query\Apartment\SqlDoctrineQueryApartmentReadModelRepository")
 * @ORM\Table(name="apartment_read_model")
 */
class ApartmentReadModel
{
    /**
     * @ORM\Id
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
     * @ORM\Column(type="string", length=255)
     */
    private string $street;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $postalCode;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $houseNumber;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $apartmentNumber;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $city;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $country;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $description;

//    /**
//     * @ORM\OneToMany(targetEntity="Room", mappedBy="apartment")
//     * @var array<RoomReadModel> $rooms
//     */
//    private array $rooms;

    /**
     * @param int $id
     * @param string $ownerId
     * @param string $street
     * @param string $postalCode
     * @param string $houseNumber
     * @param string $apartmentNumber
     * @param string $city
     * @param string $country
     * @param string $description
     */
    public function __construct(int    $id,
                                 string $ownerId,
                                 string $street,
                                 string $postalCode,
                                 string $houseNumber,
                                 string $apartmentNumber,
                                 string $city,
                                 string $country,
                                 string $description)
    {
        $this->id = $id;
        $this->ownerId = $ownerId;
        $this->street = $street;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->apartmentNumber = $apartmentNumber;
        $this->city = $city;
        $this->country = $country;
        $this->description = $description;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * @return string
     */
    public function getApartmentNumber(): string
    {
        return $this->apartmentNumber;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }


}