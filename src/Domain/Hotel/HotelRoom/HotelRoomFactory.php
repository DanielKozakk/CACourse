<?php

namespace Domain\Hotel\HotelRoom;

use Infrastructure\Persistence\Doctrine\Hotel\SqlDoctrineHotelRepository;

class HotelRoomFactory
{

    private SqlDoctrineHotelRepository $sqlDoctrineHotelRepository;

    /**
     * @param SqlDoctrineHotelRepository $sqlDoctrineHotelRepository
     */
    public function __construct(SqlDoctrineHotelRepository $sqlDoctrineHotelRepository)
    {
        $this->sqlDoctrineHotelRepository = $sqlDoctrineHotelRepository;
    }


    /**
     * @param int $hotelId
     * @param int $hotelRoomNumber
     * @param array<string, float> $spacesDefinition
     * @param string $description
     * @return HotelRoom
     */
    public function create(int $hotelId,
                           int    $hotelRoomNumber,
//                           array  $spacesDefinition,
                           string $description
    ): HotelRoom {
//        $spaces = [];
//        foreach ($spacesDefinition as $name => $size){
//
//            /**
//             * @var SquareMeter $squareMeter
//             */
//            $squareMeter = new SquareMeter($size);
//            $spaces[] = new Space($name, $squareMeter);
//        }


        return new HotelRoom($this->sqlDoctrineHotelRepository->find($hotelId), $hotelRoomNumber,
//            $spaces,
            $description );
    }
}