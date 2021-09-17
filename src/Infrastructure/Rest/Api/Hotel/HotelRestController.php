<?php

namespace Infrastructure\Rest\Api\Hotel;
//TODO: https://api-platform.com/ - tutaj jest dokumentacja do tworzenia ładnego api do symfony.
// Nie jestem pewien, czy tworzy się tam takie kontrollery - dostosuj funkcjonalność tej klasy do powyższego frameworka, gdy już będziesz chciał używac funkcjonalności.
use Application\Hotel\HotelApplicationService;
use Query\Hotel\HotelReadModel;
use Query\Hotel\QueryHotelRepository;

class HotelRestController
{

    private HotelApplicationService $hotelApplicationService;
    private QueryHotelRepository $queryHotelRepository;

    /**
     * @param HotelApplicationService $hotelApplicationService
     * @param QueryHotelRepository $queryHotelRepository
     */
    public function __construct(HotelApplicationService $hotelApplicationService, QueryHotelRepository $queryHotelRepository)
    {
        $this->hotelApplicationService = $hotelApplicationService;
        $this->queryHotelRepository = $queryHotelRepository;
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

    /**
     * @return array<HotelReadModel>
     */
    public function findAll ():array{
        return $this->queryHotelRepository->findAll();
    }

}