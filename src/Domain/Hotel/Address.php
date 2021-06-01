<?php


namespace App\Domain\Hotel;


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
    private $city;

    /**
     * @var string
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