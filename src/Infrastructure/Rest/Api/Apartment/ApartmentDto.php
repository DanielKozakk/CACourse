<?php


namespace App\Infrastructure\Rest\Api\Apartment;


class ApartmentDto
{
    /**
     * @var string
     */
    private string $ownerId;
    /**
     * @var String
     */
    private String $street;
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
     */
    private string $description;
    /**
     * @var array
     */
    private array $roomsDefinition;

    /**
     * ApartmentDto constructor.
     * @param string $ownerId
     * @param String $street
     * @param string $postalCode
     * @param string $houseNumber
     * @param string $apartmentNumber
     * @param string $city
     * @param string $country
     * @param string $description
     * @param array $roomsDefinition
     */
    public function __construct(string $ownerId, string $street, string $postalCode, string $houseNumber, string $apartmentNumber, string $city, string $country, string $description, array $roomsDefinition)
    {
        $this->ownerId = $ownerId;
        $this->street = $street;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->apartmentNumber = $apartmentNumber;
        $this->city = $city;
        $this->country = $country;
        $this->description = $description;
        $this->roomsDefinition = $roomsDefinition;
    }

    /**
     * @return string
     */
    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    /**
     * @return String
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

    /**
     * @return array
     */
    public function getRoomsDefinition(): array
    {
        return $this->roomsDefinition;
    }


}