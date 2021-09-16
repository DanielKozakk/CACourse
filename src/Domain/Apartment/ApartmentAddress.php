<?php

namespace Domain\Apartment;

use Doctrine\ORM\Mapping\Embeddable;

/** @Embeddable */
class ApartmentAddress
{

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

    public function __construct(string $street, string $postalCode, string $houseNumber, string $apartmentNumber, string $city, string $country)
    {
        $this->street = $street;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->apartmentNumber = $apartmentNumber;
        $this->city = $city;
        $this->country = $country;

    }
}