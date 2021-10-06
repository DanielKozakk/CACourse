<?php

namespace Infrastructure\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Apartment\ApartmentFactory;
use Domain\Hotel\Hotel;
use Domain\Hotel\HotelFactory;
use Domain\Hotel\HotelRoom\HotelRoomFactory;
use Domain\Hotel\HotelRoom\Space;
use Domain\Hotel\HotelRoom\SquareMeter;
use Infrastructure\Persistence\Doctrine\Apartment\DoctrineApartmentRepository;
use Infrastructure\Persistence\Doctrine\Hotel\HotelRoom\SqlDoctrineHotelRoomRepository;
use Infrastructure\Persistence\Doctrine\Hotel\SqlDoctrineHotelRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    private SqlDoctrineHotelRepository $sqlDoctrineHotelRepository;
    private SqlDoctrineHotelRoomRepository $sqlDoctrineHotelRoomRepository;
    private HotelRoomFactory $hotelRoomFactory;

    /**
     * @param SqlDoctrineHotelRepository $sqlDoctrineHotelRepository
     * @param SqlDoctrineHotelRoomRepository $sqlDoctrineHotelRoomRepository
     * @param HotelRoomFactory $hotelRoomFactory
     */
    public function __construct(SqlDoctrineHotelRepository $sqlDoctrineHotelRepository, SqlDoctrineHotelRoomRepository $sqlDoctrineHotelRoomRepository, HotelRoomFactory $hotelRoomFactory)
    {
        $this->sqlDoctrineHotelRepository = $sqlDoctrineHotelRepository;
        $this->sqlDoctrineHotelRoomRepository = $sqlDoctrineHotelRoomRepository;
        $this->hotelRoomFactory = $hotelRoomFactory;
    }


    /**
     * @throws \ReflectionException
     */
    #[Route('/main', name: 'main')]
    public function index(): Response
    {


        $hr = $this->hotelRoomFactory->create(1, 35, ['kuchnia' => 2.5, 'przedpokuj' => 24], 'niewielka szopa w pobliżu śmietniska');

        $this->sqlDoctrineHotelRoomRepository->addRoomToHotel($hr);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainController.php',
        ]);
    }
}
