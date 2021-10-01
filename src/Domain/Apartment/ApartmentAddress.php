<?php

namespace Domain\Apartment;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
class ApartmentAddress
{

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
     * @param string $street
     * @param string $postalCode
     * @param string $houseNumber
     * @param string $apartmentNumber
     * @param string $city
     * @param string $country
     */
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