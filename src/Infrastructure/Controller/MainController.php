<?php

namespace Infrastructure\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Apartment\ApartmentFactory;
use Infrastructure\Persistence\Doctrine\Apartment\DoctrineApartmentRepository;
use Query\Apartment\ApartmentReadModel;
use Query\Apartment\SqlDoctrineQueryApartmentReadModelRepository;
use Query\Apartment\SqlDoctrineQueryApartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private DoctrineApartmentRepository $doctrineApartmentRepository;

    /**
     * @param DoctrineApartmentRepository $doctrineApartmentRepository
     */
    public function __construct(DoctrineApartmentRepository $doctrineApartmentRepository)
    {
        $this->doctrineApartmentRepository = $doctrineApartmentRepository;
    }


    #[Route('/main', name: 'main')]
    public function index(): Response
    {


        $apartment = (new ApartmentFactory())->create('twoja_srara', 'sraDio_mara', 'abc', 'abc', 'abc', 'abc', 'abc', 'abc', ['abc' => 1.4]);

        $this->doctrineApartmentRepository->save($apartment);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainController.php',
        ]);
    }
}
