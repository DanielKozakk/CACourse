<?php

namespace App\Infrastructure\Rest\Api\HotelRoom;

use App\Application\HotelRoom\HotelRoomApplicationService;
use App\Query\Hotel\QueryHotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HotelRoomRestController extends AbstractController
{
    /**
     * @var HotelRoomApplicationService
     */
    private HotelRoomApplicationService $hotelRoomApplicationService;

    private QueryHotelRepository $queryHotelRepository;

    /**
     * HotelRoomRestController constructor.
     * @param HotelRoomApplicationService $hotelRoomApplicationService
     * @param QueryHotelRepository $queryHotelRepository
     */
    public function __construct(HotelRoomApplicationService $hotelRoomApplicationService, QueryHotelRepository $queryHotelRepository)
    {
        $this->hotelRoomApplicationService = $hotelRoomApplicationService;
        $this->queryHotelRepository = $queryHotelRepository;
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

    public function findAll(string $hotelId){
        $this->queryHotelRepository->getRoomsInHotel($hotelId);
    }

}