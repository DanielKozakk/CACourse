<?php

namespace Domain\Apartment;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity
 *
 */
class Room
{
    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", length=255)
     */
    private int $id;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $name;
    /**
     * @var SquareMeter
     * @Embedded(class = "SquareMeter")
     */
    private $squareMeter;

    /**
     * @var Apartment
     * @ManyToOne(targetEntity="Apartment", inversedBy="rooms")
     */
    private Apartment $apartment;

    public function __construct(string $name, SquareMeter $squareMeter, Apartment $apartment)
    {
        $this->name = $name;
        $this->squareMeter = $squareMeter;
        $this->apartment = $apartment;
        $apartment->addRoom($this);

    }
}