<?php

namespace Domain\Hotel;

class HotelAddress
{
    /**
     * @var string
     */
    private $street;
    /**
     * @var string
     */
    private $buildingNumber;
    /**
     * @var string
     */
    private $postalCode;
    /**
     * @var string
     */
    private $city;
    /**
     * @var string
     */
    private $country;

    public function __construct(string $street, string $buildingNumber, string $postalCode, string $city, string $country)
    {
        $this->street = $street;
        $this->buildingNumber = $buildingNumber;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->country = $country;
    }
}