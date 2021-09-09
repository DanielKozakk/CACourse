<?php

namespace Infrastructure\Rest\Api\Hotel\HotelRoom;

use Application\Hotel\HotelRoom\HotelRoomApplicationService;

class HotelRoomRestController
{
    private HotelRoomApplicationService $hotelRoomApplicationService;

    /**
     * @param HotelRoomApplicationService $hotelRoomApplicationService
     */
    public function __construct(HotelRoomApplicationService $hotelRoomApplicationService)
    {
        $this->hotelRoomApplicationService = $hotelRoomApplicationService;
    }


    public function add(HotelRoomCreationDto $hotelRoomDto){
        $this->hotelRoomApplicationService->addRoomToHotel(
            $hotelRoomDto->getHotelId(),
            $hotelRoomDto->getHotelNumber(),
            $hotelRoomDto->getSpacesDefinition(),
            $hotelRoomDto->getDescription(),
        );
    }

    //book/id
    public function book(string $id, HotelBookingDto $hotelBookingDto){
        $this->hotelRoomApplicationService->bookHotelRoom($id, $hotelBookingDto);
    }

}