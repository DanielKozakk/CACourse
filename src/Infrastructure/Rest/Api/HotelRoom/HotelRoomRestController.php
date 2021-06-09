<?php

namespace App\Infrastructure\Rest\Api\HotelRoom;

use App\Application\HotelRoom\HotelRoomApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HotelRoomRestController extends AbstractController
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
            $hotelRoomDto->getDescription(),
            $hotelRoomDto->getHotelId(),
        );
    }

    public function book(int $id, HotelRoomBookingDto $hotelRoomBookingDto){
        $this->hotelRoomApplicationService->book($id,$hotelRoomBookingDto->getTenantId(), $hotelRoomBookingDto->getStartDate(), $hotelRoomBookingDto->getEndDate());
    }

}