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

}