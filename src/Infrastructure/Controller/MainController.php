<?php

namespace Infrastructure\Controller;

use Domain\Apartment\ApartmentFactory;
use Infrastructure\Persistence\Doctrine\Apartment\DoctrineApartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
private DoctrineApartmentRepository $doctrineApartmentRepository;

    /**
     * @param DoctrineApartmentRepository $doctrineApartmentRepository
     */
    public function __construct(
        DoctrineApartmentRepository $doctrineApartmentRepository
    )
    {
        $this->doctrineApartmentRepository = $doctrineApartmentRepository;
    }


    #[Route('/main', name: 'main')]
    public function index(): Response
    {

        $apartment = (new ApartmentFactory())->create(
            "abc",
            "zachodnia",
            "31-201",
            "21",
            "25",
            "Kraków",
            "Poland",
            "dobre to",
            ["jeden pokój" => 2.0]);

//        $apartmentRepo = new DoctrineApartmentRepository($this->sqlDoctrineApartmentRepository);
//        $apartmentRepo->save($apartment);
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainController.php',
        ]);
    }
}
