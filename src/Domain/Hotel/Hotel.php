<?php

namespace Domain\Hotel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use Domain\Hotel\HotelRoom\HotelRoom;
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
     * @ORM\OneToMany(targetEntity="Domain\Hotel\HotelRoom\HotelRoom", mappedBy="hotel", cascade={"persist"})
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

    public function addRoom(int $hotelRoomNumber, array $spacesDefinition, string $description, HotelRepository $hotelRepository)
    {
        $hotelRoom = (new HotelRoomFactory($hotelRepository))->create(
            $this->id,
            $hotelRoomNumber,
            $spacesDefinition,
            $description);

        $this->hotelRooms->add($hotelRoom);
    }

    public function getIdOfRoom(int $hotelRoomNumber): int
    {
        return $this->getHotelRoom($hotelRoomNumber)->getId();
    }

    public function getHotelRoom(int $hotelRoomNumber): HotelRoom|null
    {
        $he = array_values(array_filter($this->hotelRooms->toArray(), function(HotelRoom $value) use ($hotelRoomNumber) {
            return $value->getHotelRoomNumber() === $hotelRoomNumber;
        }));

        return $he[0];
    }

    /**
     * @return ArrayCollection
     */
    public function getHotelRooms(): mixed
    {
        return $this->hotelRooms;
    }




}