<?php


namespace App\Domain\Apartment;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * Class Room
 * @package App\Domain\Apartment
 * @Entity()
 */
class Room
{
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
     * @param string $name
     * @param SquareMeter $squareMeter
     */
    public function __construct(string $name, SquareMeter $squareMeter)
    {
        $this->name = $name;
        $this->squareMeter = $squareMeter;
    }


}