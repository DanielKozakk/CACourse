<?php


namespace App\Infrastructure\Rest\Api\Hotel;


use App\Application\Hotel\HotelApplicationService;
use App\Query\Hotel\HotelReadModel;
use App\Query\Hotel\QueryHotelRepository;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HotelRestController extends AbstractController
{

    /**
     * @var HotelApplicationService
     */
    private HotelApplicationService $hotelApplicationService;

    private QueryHotelRepository $queryHotelRepository;

    /**
     * HotelRestController constructor.
     * @param HotelApplicationService $hotelApplicationService
     * @param QueryHotelRepository $queryHotelRepository
     */
    public function __construct(HotelApplicationService $hotelApplicationService, QueryHotelRepository $queryHotelRepository)
    {
        $this->hotelApplicationService = $hotelApplicationService;
        $this->queryHotelRepository = $queryHotelRepository;
    }


    public function addHotel(HotelDto $hotelDto)
    {
        $this->hotelApplicationService->saveHotel($hotelDto->getName(), $hotelDto->getStreet(), $hotelDto->getPostalCode(), $hotelDto->getCity(), $hotelDto->getCountry());
    }

    /**
     * @return HotelReadModel[]
     * TODO: jakieś anootacje do api
     */
    public function getAllHotels() : array{
        return $this->queryHotelRepository->getAllHotels();
    }


}