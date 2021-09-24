<?php

namespace Domain\Hotel;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;

/**
 * @ ORM\Entity(repositoryClass="\Infrastructure\Persistence\Doctrine\Hotel\SqlDoctrineHotelRepository")
 */
class Hotel
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    /**
     * @var HotelAddress
     * @Embedded(class = "HotelAddress")
     *
     */
    private $address;

    public function __construct(string $name, HotelAddress $address)
    {
        $this->name = $name;
        $this->address = $address;
    }
}