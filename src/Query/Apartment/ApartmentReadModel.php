<?php


namespace App\Query\Apartment;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * Class Apartment
 * @package App\Domain\Apartment
 *
 * TODO: zmień repository prawdopodobnie będzie to potrzebne
 * TODO: Połącz tą encję z encją Apartment z domeny, przeczytaj w tym celu dokumentacje Doctrine
 * @ Entity(repositoryClass="AApp\Query\Apartment\QueryApartmentRepository")
 *
 *
 */
class ApartmentReadModel{

    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var string
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $ownerId;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var string
     */
    private $street;
    /**
     * @var string
     */
    private $postalCode;
    /**
     * @var string
     */
    private $houseNumber;
    /**
     * @var string
     */
    private $apartmentNumber;
    /**
     * @var string
     */
    private $city;
    /**
     * @var string
     */
    private $country;
    /**
     * @ORM\OneToMany(targetEntity=RoomReadModel, mappedBy="apartment")
     */
    private $rooms;

    /**
     * ApartmentReadModel constructor.
     * @param string $id
     * @param string $ownerId
     * @param string $description
     * @param string $street
     * @param string $postalCode
     * @param string $houseNumber
     * @param string $apartmentNumber
     * @param string $city
     * @param string $country
     * @param $rooms
     */
    public function __construct(string $id, string $ownerId, string $description, string $street, string $postalCode, string $houseNumber, string $apartmentNumber, string $city, string $country, $rooms)
    {
        $this->id = $id;
        $this->ownerId = $ownerId;
        $this->description = $description;
        $this->street = $street;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->apartmentNumber = $apartmentNumber;
        $this->city = $city;
        $this->country = $country;
        $this->rooms = $rooms;
    }

    /**
     * @return string
     */
    public function getId(): string
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
    public function getDescription(): string
    {
        return $this->description;
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
     * @return mixed
     */
    public function getRooms()
    {
        return $this->rooms;
    }



}