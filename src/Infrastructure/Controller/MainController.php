<?php

namespace Infrastructure\Controller;

use Application\Apartment\ApartmentApplicationService;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Apartment\ApartmentFactory;
use Domain\Apartment\ApartmentRepository;
use Domain\Hotel\Hotel;
use Domain\Hotel\HotelBookingHistory\HotelBookingHistory;
use Domain\Hotel\HotelBookingHistory\HotelBookingHistoryRepository;
use Domain\Hotel\HotelFactory;
use Domain\Hotel\HotelRoom\HotelRoomFactory;
use Domain\Hotel\HotelRoom\Space;
use Domain\Hotel\HotelRoom\SquareMeter;
use Infrastructure\Persistence\Doctrine\Apartment\DoctrineApartmentRepository;
use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use Infrastructure\Persistence\Doctrine\Hotel\HotelRoom\DoctrineHotelRoomRepository;
use Infrastructure\Persistence\Doctrine\Hotel\HotelRoom\SqlDoctrineHotelRoomRepository;
use Infrastructure\Persistence\Doctrine\Hotel\HotelRoomBookingHistory\DoctrineHotelRoomBookingHistoryRepository;
use Infrastructure\Persistence\Doctrine\Hotel\SqlDoctrineHotelRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    private ApartmentApplicationService $apartmentApplicationService;

    /**
     * @param ApartmentApplicationService $apartmentApplicationService
     */
    public function __construct(ApartmentApplicationService $apartmentApplicationService)
    {
        $this->apartmentApplicationService = $apartmentApplicationService;
    }


    /**
     */
    #[Route('/main', name: 'main')]
    public function index(): Response
    {

        $this->apartmentApplicationService->book(1, '21', new DateTime('2021-01-01'), new DateTime('2021-01-02'));

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainController.php',
        ]);
    }
}
