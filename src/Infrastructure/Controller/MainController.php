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

    private SqlDoctrineQueryApartmentReadModelRepository $sqlDoctrineQueryApartmentReadModelRepository;
    private EntityManagerInterface $em;

    /**
     * @param SqlDoctrineQueryApartmentReadModelRepository $sqlDoctrineQueryApartmentReadModelRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(SqlDoctrineQueryApartmentReadModelRepository $sqlDoctrineQueryApartmentReadModelRepository, EntityManagerInterface $em)
    {
        $this->sqlDoctrineQueryApartmentReadModelRepository = $sqlDoctrineQueryApartmentReadModelRepository;
        $this->em = $em;
    }


    #[Route('/main', name: 'main')]
    public function index(): Response
    {
        
        $apartmentReadModel = new ApartmentReadModel('abc','abc','abc','abc','abc','abc','abc','abc');

        $this->em->persist($apartmentReadModel);
        $this->em->flush();

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainController.php',
        ]);
    }
}
