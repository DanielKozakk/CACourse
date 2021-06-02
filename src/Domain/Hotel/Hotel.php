<?php


namespace App\Domain\Hotel;


use App\Domain\Apartment\Room;
use App\Domain\HotelRoom\HotelRoom;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Hotel
 * @package App\Domain\Hotel
 *  @Entity(repositoryClass="App\Infrastructure\Persistance\Doctrine\Hotel\DoctrineSqlHotelRepository")
 */
class Hotel
{

    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var string
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var Address
     * @ORM\Embedded(class="Address")
     */
    private $address;

    /**
     * @var HotelRoom[]
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="hotelId")
     */
    private $rooms = [];

    /**
     * Hotel constructor.
     * @param string $name
     * @param Address $address
     */
    public function __construct(string $name, Address $address)
    {
        $this->name = $name;
        $this->address = $address;
    }

    /**
     * @param Room[] $rooms
     */
    public function addRoom(Room $room): void
    {
        $this->rooms[] = $room;
    }

}