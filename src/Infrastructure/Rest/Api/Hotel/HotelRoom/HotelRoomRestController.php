<?php

namespace Infrastructure\Rest\Api\Hotel\HotelRoom;

use Application\Hotel\HotelRoom\HotelRoomApplicationService;
use Query\Hotel\HotelRoom\HotelRoomReadModel;
use Query\Hotel\HotelRoom\QueryHotelRoomRepository;

class HotelRoomRestController
{
    private HotelRoomApplicationService $hotelRoomApplicationService;
    private QueryHotelRoomRepository $queryHotelRoomRepository;

    /**
     * @param HotelRoomApplicationService $hotelRoomApplicationService
     * @param QueryHotelRoomRepository $queryHotelRoomRepository
     */
    public function __construct(HotelRoomApplicationService $hotelRoomApplicationService, QueryHotelRoomRepository $queryHotelRoomRepository)
    {
        $this->hotelRoomApplicationService = $hotelRoomApplicationService;
        $this->queryHotelRoomRepository = $queryHotelRoomRepository;
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
    public function book(string $hotelRoomId, HotelBookingDto $hotelBookingDto){
        $this->hotelRoomApplicationService->bookHotelRoom($hotelRoomId, $hotelBookingDto->getTenantId(), $hotelBookingDto->getDays());
    }

    /**
     * @param string $hotelId
     * @return array<HotelRoomReadModel>
     * //route - /hotel/{hotelId}
     */
    public function findAll (string $hotelId):array{
        return $this->queryHotelRoomRepository->findAllByHotelId($hotelId);
    }

}