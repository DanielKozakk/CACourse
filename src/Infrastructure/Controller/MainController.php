<?php

namespace Infrastructure\Controller;

use Domain\Apartment\ApartmentFactory;
use Infrastructure\Persistence\Doctrine\Apartment\DoctrineApartmentRepository;
use Query\Apartment\SqlDoctrineQueryApartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
//private DoctrineApartmentRepository $doctrineApartmentRepository;
//
//    /**
//     * @param DoctrineApartmentRepository $doctrineApartmentRepository
//     */
//    public function __construct(
//        DoctrineApartmentRepository $doctrineApartmentRepository
//    )
//    {
//        $this->doctrineApartmentRepository = $doctrineApartmentRepository;
//    }

    private SqlDoctrineQueryApartmentRepository $sqlDoctrineQueryApartmentRepository;

    /**
     * @param SqlDoctrineQueryApartmentRepository $sqlDoctrineQueryApartmentRepository
     */
    public function __construct(SqlDoctrineQueryApartmentRepository $sqlDoctrineQueryApartmentRepository)
    {
        $this->sqlDoctrineQueryApartmentRepository = $sqlDoctrineQueryApartmentRepository;
    }


    #[Route('/main', name: 'main')]
    public function index(): Response
    {


        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainController.php',
        ]);
    }
}
