<?php


namespace App\Domain\Hotel;


use App\Domain\Apartment\Room;
use App\Domain\HotelRoom\HotelRoom;

class Hotel
{

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var HotelRoom[]
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