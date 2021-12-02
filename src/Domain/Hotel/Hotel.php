<?php

namespace Domain\Hotel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use Domain\Hotel\HotelRoom\HotelRoomFactory;

/**
 * @ORM\Entity(repositoryClass="\Infrastructure\Persistence\Doctrine\Hotel\SqlDoctrineHotelRepository")
 */
class Hotel
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

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

    /**
     *
     * @ORM\OneToMany(targetEntity="Domain\Hotel\HotelRoom\HotelRoom", mappedBy="hotel")
     */
    private $hotelRooms;

    public function __construct(string $name, HotelAddress $address)
    {
        $this->name = $name;
        $this->address = $address;
        $this->hotelRooms = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function addRoom(int $hotelNumber, array $spacesDefinition, string $description)
    {
        $hotelRoom = (new HotelRoomFactory($this->doctrineHotelRepository))->create(
            $this->id,
            $hotelNumber,
            $spacesDefinition,
            $description);

        $this->hotelRooms->add($hotelRoom);

    }

}