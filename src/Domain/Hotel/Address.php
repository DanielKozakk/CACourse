<?php


namespace App\Domain\Hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Address
{

    /**
     * @ORM\Column(type="string")
     */
    private $street;

    /**
     * @ORM\Column(type="string")
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * Address constructor.
     * @param string $street
     * @param string $postalCode
     * @param string $city
     * @param string $country
     */
    public function __construct(string $street, string $postalCode, string $city, string $country)
    {
        $this->street = $street;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->country = $country;
    }


}