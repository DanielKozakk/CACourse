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

}