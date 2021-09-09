<?php

namespace Application\Hotel\HotelRoom;

use Domain\Hotel\HotelRoom\HotelRoom;
use Domain\Hotel\HotelRoom\HotelRoomFactory;
use Domain\Hotel\HotelRoom\HotelRoomRepository;
use Infrastructure\Rest\Api\Hotel\HotelRoom\HotelBookingDto;

class HotelRoomApplicationService
{
    private HotelRoomRepository $hotelRoomRepository;

    /**
     * @param HotelRoomRepository $hotelRoomRepository
     */
    public function __construct(HotelRoomRepository $hotelRoomRepository)
    {
        $this->hotelRoomRepository = $hotelRoomRepository;
    }

    /**
     * @param string $hotelId
     * @param int $hotelNumber
     * @param array<string, float> $spacesDefinition
     * @param string $description
     */
    public function addRoomToHotel(
        string $hotelId,
        int    $hotelNumber,
        array  $spacesDefinition,
        string $description
    ): void
    {
        $hotelRoom = (new HotelRoomFactory)->create($hotelId, $hotelNumber, $spacesDefinition, $description);

        $this->hotelRoomRepository->save($hotelRoom);
    }

    public function bookHotelRoom(string $id, HotelBookingDto $hotelBookingDto)
    {

    }

}