<?php


namespace App\Domain\HotelRoom;


class HotelRoomFactory
{

    public function create(
        string $hotelId,
        int $number,
        array $spacesDefinition,
        string $description
    ) : HotelRoom{

        /**
         * @var Space[]
         */
        $spaces = [];

        foreach($spacesDefinition as $spaceName => $spaceSize){
            $spaces[] = new Space($spaceName, new SquareMeter($spaceSize));
        }

        $hotelRoom = new HotelRoom($hotelId, $number, $spacesDefinition, $description);


    }
}