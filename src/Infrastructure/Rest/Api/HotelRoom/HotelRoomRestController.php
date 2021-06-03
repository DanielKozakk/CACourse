<?php


namespace App\Infrastructure\Rest\Api\HotelRoom;


use App\Application\Hotel\HotelRoomApplicationService;
use App\Domain\HotelRoom\HotelRoom;
use App\Infrastructure\Rest\Api\Hotel\HotelDto;

class HotelRoomRestController
{


    /**
     * @var HotelRoomApplicationService
     */
    private HotelRoomApplicationService $hotelRoomApplicationService;

    /**
     * HotelRoomRestController constructor.
     * @param HotelRoomApplicationService $hotelRoomApplicationService
     */
    public function __construct(HotelRoomApplicationService $hotelRoomApplicationService)
    {
        $this->hotelRoomApplicationService = $hotelRoomApplicationService;
    }

    public function addHotelRoom(HotelRoomDto $hotelRoomDto){
        $this->hotelRoomApplicationService->add(
            $hotelRoomDto->getNumber(),
            $hotelRoomDto->getSpacesDefinition(),
            $hotelRoomDto->getDescription()
        );
    }
}