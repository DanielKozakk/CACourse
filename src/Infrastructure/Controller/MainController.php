<?php

namespace App\Infrastructure\Controller;

use App\Application\Apartment\ApartmentApplicationService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    private ApartmentApplicationService $apartmentApplicationService;

    /**
     * MainController constructor.
     * @param ApartmentApplicationService $apartmentApplicationService
     */
    public function __construct(ApartmentApplicationService $apartmentApplicationService)
    {
        $this->apartmentApplicationService = $apartmentApplicationService;
    }


    #[Route('/', name: 'main')]
    public function index(): Response
    {
        $this->apartmentApplicationService->book('abc', 'abc', new DateTime(), new DateTime());
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MaineeeeController',
        ]);
    }
}
