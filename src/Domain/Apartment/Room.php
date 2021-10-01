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
     * @ORM\Column(type="string", length=255)
     */
    private string $id;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    /**
     * @var SquareMeter
     * @Embedded(class = "SquareMeter")
     */
    private $squareMeter;

    /**
     * @var Apartment
     * @ManyToOne(targetEntity="Apartment", inversedBy="rooms")
     */
    private $apartment;

    public function __construct(string $name, SquareMeter $squareMeter)
    {
        $this->name = $name;
        $this->squareMeter = $squareMeter;

    }
}