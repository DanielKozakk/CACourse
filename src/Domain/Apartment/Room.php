<?php


namespace App\Domain\Apartment;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * Class Room
 * @package App\Domain\Apartment
 * @Entity
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var SquareMeter
     */
    private $squareMeter;

    /**
     * @ORM\ManyToOne(targetEntity=Apartment::class, inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $apartment;

    /**
     * Room constructor.
     * @param $id
     * @param string $name
     * @param SquareMeter $squareMeter
     * @param $apartment
     */
    public function __construct($id, string $name, SquareMeter $squareMeter, $apartment)
    {
        $this->id = $id;
        $this->name = $name;
        $this->squareMeter = $squareMeter;
        $this->apartment = $apartment;
    }


}