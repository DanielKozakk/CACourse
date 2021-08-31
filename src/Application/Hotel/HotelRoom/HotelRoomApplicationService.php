<?php

namespace Application\Hotel\HotelRoom;

use Domain\Hotel\HotelRoom\HotelRoom;
use Domain\Hotel\HotelRoom\HotelRoomFactory;

class HotelRoomApplicationService
{
    /**
     * @param string $hotelId
     * @param int $hotelNumber
     * @param array<string, double> $spacesDefinition
     * @param string $description
     */
    public function addRoomToHotel(
        string $hotelId,
        int    $hotelNumber,
        array  $spacesDefinition,
        string $description
    ): void
    {

        /**
         * @var HotelRoom $hotelRoom
         */
        $hotelRoom = (new HotelRoomFactory)->create($hotelId, $hotelNumber, $spacesDefinition, $description);

    }

}