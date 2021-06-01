<?php


namespace App\Application\Hotel;


use App\Domain\Apartment\Room;
use App\Domain\Hotel\Hotel;
use App\Domain\Hotel\HotelFactory;
use App\Domain\HotelRoom\HotelRoom;
use App\Domain\HotelRoom\HotelRoomFactory;

class HotelRoomApplicationService
{
    /**
     * @param string $hotelId
     * @param int $number
     * @param string $description
     * @param array $rooms
     */
    public function addRoomToHotel(
        string $hotelId,
        int $number,
        array $spacesDefinition,
        string $description
    ){

        /**
         * @var HotelRoom
         */
        $hotelRoom = (new HotelRoomFactory())->create($hotelId, $number, $spacesDefinition, $description);


    }
}