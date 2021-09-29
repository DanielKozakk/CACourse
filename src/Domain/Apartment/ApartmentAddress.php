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
    private $houseNumber;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $apartmentNumber;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $city;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
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