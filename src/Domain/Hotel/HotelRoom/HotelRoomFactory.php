<?php

namespace Domain\Hotel\HotelRoom;

use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use Infrastructure\Persistence\Doctrine\Hotel\SqlDoctrineHotelRepository;

class HotelRoomFactory
{
    private DoctrineHotelRepository $doctrineHotelRepository;

    /**
     * @param DoctrineHotelRepository $doctrineHotelRepository
     */
    public function __construct(DoctrineHotelRepository $doctrineHotelRepository)
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
        $newHotelRoom = new HotelRoom($this->doctrineHotelRepository->findById($hotelId), $hotelRoomNumber,
            $description
        );

        foreach ($spacesDefinition as $name => $size){
            Space::assignNewSpaceToHotelRoom($name, $size, $newHotelRoom);
        }
        return $newHotelRoom;
    }
}