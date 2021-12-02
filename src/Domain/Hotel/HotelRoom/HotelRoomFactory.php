<?php

namespace Domain\Hotel\HotelRoom;

use Domain\Hotel\HotelRepository;
use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use Infrastructure\Persistence\Doctrine\Hotel\SqlDoctrineHotelRepository;

class HotelRoomFactory
{
    private HotelRepository $doctrineHotelRepository;

    /**
     * @param HotelRepository $doctrineHotelRepository
     */
    public function __construct(HotelRepository $doctrineHotelRepository)
    {
        $this->doctrineHotelRepository = $doctrineHotelRepository;
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
                           array  $spacesDefinition,
                           string $description
    ): HotelRoom {
        $newHotelRoom = new HotelRoom($this->doctrineHotelRepository->findHotelById($hotelId), $hotelRoomNumber,
            $description
        );

        foreach ($spacesDefinition as $name => $size){
            Space::assignNewSpaceToHotelRoom($name, $size, $newHotelRoom);
        }
        return $newHotelRoom;
    }
}