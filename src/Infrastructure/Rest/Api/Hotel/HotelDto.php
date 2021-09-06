<?php

namespace Infrastructure\Rest\Api\Hotel;

class HotelDto
{
    private string $name;
    private string $street;
    private string $postalCode;
    private string $flatNumber;
    private string $city;
    private string $country;

    /**
     * @param string $name
     * @param string $street
     * @param string $postalCode
     * @param string $flatNumber
     * @param string $city
     * @param string $country
     */
    public function __construct(string $name, string $street, string $postalCode, string $flatNumber, string $city, string $country)
    {
        $this->name = $name;
        $this->street = $street;
        $this->postalCode = $postalCode;
        $this->flatNumber = $flatNumber;
        $this->city = $city;
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
    public function getFlatNumber(): string
    {
        return $this->flatNumber;
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


}