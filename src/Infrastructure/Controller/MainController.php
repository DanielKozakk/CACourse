<?php

namespace Infrastructure\Controller;

use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Apartment\ApartmentFactory;
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

    private DoctrineHotelRepository $doctrineHotelRepository;
    private DoctrineHotelRoomRepository $doctrineHotelRoomRepository;
    private HotelRoomFactory $hotelRoomFactory;
    private DoctrineHotelRoomBookingHistoryRepository $doctrineHotelRoomBookingHistoryRepository;

    /**
     * @param DoctrineHotelRepository $doctrineHotelRepository
     * @param DoctrineHotelRoomRepository $doctrineHotelRoomRepository
     * @param HotelRoomFactory $hotelRoomFactory
     * @param DoctrineHotelRoomBookingHistoryRepository $hotelBookingHistoryRepository
     */
    public function __construct(DoctrineHotelRepository $doctrineHotelRepository, DoctrineHotelRoomRepository $doctrineHotelRoomRepository, HotelRoomFactory $hotelRoomFactory, DoctrineHotelRoomBookingHistoryRepository $hotelBookingHistoryRepository)
    {
        $this->doctrineHotelRepository = $doctrineHotelRepository;
        $this->doctrineHotelRoomRepository = $doctrineHotelRoomRepository;
        $this->hotelRoomFactory = $hotelRoomFactory;
        $this->doctrineHotelRoomBookingHistoryRepository = $hotelBookingHistoryRepository;
    }


    /**
     * @throws \ReflectionException
     */
    #[Route('/main', name: 'main')]
    public function index(): Response
    {

//        $hotel = $this->doctrineHotelRepository->findById(1);
//        $hotelBookingHistory  = new HotelBookingHistory($hotel);
//        $hotelRoom = $this->doctrineHotelRoomRepository->findById(1);
//
//        $hotelBookingHistory->add($hotelRoom, new DateTime(), '21', [new DateTime()]);
//        $this->doctrineHotelRoomBookingHistoryRepository->save($hotelBookingHistory);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainController.php',
        ]);
    }
}
