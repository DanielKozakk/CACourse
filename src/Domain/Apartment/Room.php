<?php


namespace App\Domain\Apartment;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * Class Room
 * @package App\Domain\Apartment
 * @Entity
 * TODO: Połącz tą encję z encją RoomReadModel z read modelu, przeczytaj w tym celu dokumentacje Doctrine
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
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var SquareMeter
     * @ORM\Column(type="float")
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