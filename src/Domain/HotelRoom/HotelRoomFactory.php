<?php


namespace App\Domain\HotelRoom;


use App\Domain\Hotel\Hotel;

class HotelRoomFactory
{

    public function create(
        int $number,
        array $spacesDefinition,
        string $description,
        Hotel $hotel
    ) : HotelRoom{

        /**
         * @var Space[]
         */
        $spaces = [];

        foreach($spacesDefinition as $spaceName => $spaceSize){
            $spaces[] = new Space($spaceName, new SquareMeter($spaceSize));
        }

        $hotelRoom = new HotelRoom($number, $spacesDefinition, $description, $hotel);


    }
}