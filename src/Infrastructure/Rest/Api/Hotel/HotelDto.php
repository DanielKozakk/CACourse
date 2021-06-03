<?php


namespace App\Infrastructure\Rest\Api\Hotel;


class HotelDto
{

    /**
     * @var string
     */
    private string $name;
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
    private string $city;
    /**
     * @var string
     */
    private string $country;

    /**
     * HotelDto constructor.
     * @param string $name
     * @param string $street
     * @param string $postalCode
     * @param string $city
     * @param string $country
     */
    public function __construct(string $name, string $street, string $postalCode, string $city, string $country)
    {
        $this->name = $name;
        $this->street = $street;
        $this->postalCode = $postalCode;
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