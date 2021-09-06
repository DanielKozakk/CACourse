<?php

namespace Domain\Hotel;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embeddable;

/**
 * @Embeddable
 */
class HotelAddress
{
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $street;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $buildingNumber;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $postalCode;
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

    public function __construct(string $street, string $buildingNumber, string $postalCode, string $city, string $country)
    {
        $this->street = $street;
        $this->buildingNumber = $buildingNumber;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->country = $country;
    }
}