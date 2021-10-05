<?php

namespace Infrastructure\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Apartment\ApartmentFactory;
use Domain\Hotel\Hotel;
use Domain\Hotel\HotelFactory;
use Infrastructure\Persistence\Doctrine\Apartment\DoctrineApartmentRepository;
use Infrastructure\Persistence\Doctrine\Hotel\SqlDoctrineHotelRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    private SqlDoctrineHotelRepository $sqlDoctrineHotelRepository;

    /**
     * @param SqlDoctrineHotelRepository $sqlDoctrineHotelRepository
     */
    public function __construct(SqlDoctrineHotelRepository $sqlDoctrineHotelRepository)
    {
        $this->sqlDoctrineHotelRepository = $sqlDoctrineHotelRepository;
    }


    /**
     * @throws \ReflectionException
     */
    #[Route('/main', name: 'main')]
    public function index(): Response
    {


        $hotel = (new HotelFactory())->create('name', 'street', '12-512', '124', 'Warszawa', 'Gównopospolita Hujska');

        $this->sqlDoctrineHotelRepository->save($hotel);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainController.php',
        ]);
    }
}
