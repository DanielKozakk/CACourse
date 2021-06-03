<?php


namespace App\Infrastructure\Rest\Api\Hotel;


use App\Application\Hotel\HotelApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HotelRestController extends AbstractController
{

    /**
     * @var HotelApplicationService
     */
    private $hotelApplicationService;

    /**
     * HotelRestController constructor.
     * @param HotelApplicationService $hotelApplicationService
     */
    public function __construct(HotelApplicationService $hotelApplicationService)
    {
        $this->hotelApplicationService = $hotelApplicationService;
    }

    public function addHotel(HotelDto $hotelDto)
    {
        $this->hotelApplicationService->saveHotel($hotelDto->getName(), $hotelDto->getStreet(), $hotelDto->getPostalCode(), $hotelDto->getCity(), $hotelDto->getCountry());
    }
}