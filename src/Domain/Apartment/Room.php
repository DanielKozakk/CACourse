<?php

namespace Domain\Apartment;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity
 */
class Room
{
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    /**
     * @var SquareMeter
     * @Embedded(class = "Address")
     */
    private $squareMeter;

    /**
     * @var Apartment
     * @ManyToOne(targetEntity="Apartment", inversedBy="rooms")
     */
    private $apartment;

    public function __construct(string $name, SquareMeter $squareMeter, Apartment $apartment)
    {
        $this->name = $name;
        $this->squareMeter = $squareMeter;
        $this->apartment = $apartment;
    }
}