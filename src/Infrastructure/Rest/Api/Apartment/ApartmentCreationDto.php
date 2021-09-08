<?php

namespace Infrastructure\Rest\Api\Apartment;

class ApartmentCreationDto
{
    private string $ownerId;
    private string $street;
    private string $postalCode;
    private string $houseNumber;
    private string $apartmentNumber;
    private string $city;
    private string $country;
    private string $description;
    private array  $roomsDefinition;

    /**
     * @param string $ownerId
     * @param string $street
     * @param string $postalCode
     * @param string $houseNumber
     * @param string $apartmentNumber
     * @param string $city
     * @param string $country
     * @param string $description
     * @param array<string, float> $roomsDefinition
     */
    public function __construct(string $ownerId, string $street, string $postalCode, string $houseNumber,
                                string $apartmentNumber, string $city, string $country, string $description, array $roomsDefinition)
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

    /**
     * @return array
     */
    public function getRoomsDefinition(): array
    {
        return $this->roomsDefinition;
    }



}

