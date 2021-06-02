<?php


namespace App\Domain\Apartment;

use Doctrine\ORM\Mapping\Embeddable;

/**
 * @Embeddable
 */
class Address
{
    /**
     * @var string
     */
    private $street;
    /**
     * @var string
     */
    private $postalCode;
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

    /**
     * Address constructor.
     * @param String $street
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