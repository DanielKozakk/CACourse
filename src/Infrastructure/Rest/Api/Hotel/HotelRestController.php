<?php

namespace Infrastructure\Rest\Api\Hotel;
//TODO: https://api-platform.com/ - tutaj jest dokumentacja do tworzenia ładnego api do symfony.
// Nie jestem pewien, czy tworzy się tam takie kontrollery - dostosuj funkcjonalność tej klasy do powyższego frameworka, gdy już będziesz chciał używac funkcjonalności.
use Application\Hotel\HotelApplicationService;

class HotelRestController
{

    private HotelApplicationService $hotelApplicationService;

    /**
     * @param HotelApplicationService $hotelApplicationService
     */
    public function __construct(HotelApplicationService $hotelApplicationService)
    {
        $this->hotelApplicationService = $hotelApplicationService;
    }

    public function add(HotelDto $hotelDto){

        $this->hotelApplicationService->createHotel(
            $hotelDto->getName(),
            $hotelDto->getStreet(),
            $hotelDto->getPostalCode(),
            $hotelDto->getFlatNumber(),
            $hotelDto->getCity(),
            $hotelDto->getCountry(),
        );
    }

}