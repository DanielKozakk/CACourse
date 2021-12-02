<?php

namespace Infrastructure\Controller;

use Application\Apartment\ApartmentApplicationService;
use DateTime;
use Domain\Hotel\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    private HotelRepository $hotelRepository;

    /**
     * @param HotelRepository $hotelRepository
     */
    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }


    /**
     */
    #[Route('/main', name: 'main')]
    public function index(): Response
    {

        dump($this->hotelRepository->findHotelRoomById(1));

//        $this->apartmentApplicationService->addApartment('090909090090909',
//            'Zwycięska',
//            '20112112-12',
//            '1251221',
//            '3333333333333333333333',
//            "Cityyyyyy",
//            "Republika republiczna",
//            "Opis",
//            ['kuchnia' => 666]);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainController.php',
        ]);
    }
}
