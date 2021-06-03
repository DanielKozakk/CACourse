<?php


namespace App\Domain\HotelRoom;


class HotelRoomFactory
{

    public function create(
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

        $hotelRoom = new HotelRoom($number, $spacesDefinition, $description);


    }
}