<?php


namespace App\Domain\HotelRoom;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 *  @Entity()
 */
class Space
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var SquareMeter
     * @ORM\Embedded
     *
     */
    private $squareMeter;

    /**
     * Space constructor.
     * @param string $name
     * @param SquareMeter $squareMeter
     */
    public function __construct(string $name, SquareMeter $squareMeter)
    {
        $this->name = $name;
        $this->squareMeter = $squareMeter;
    }
}