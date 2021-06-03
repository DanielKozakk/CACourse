<?php


namespace App\Infrastructure\Rest\Api\Apartment;


use App\Application\Apartment\ApartmentApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApartmentRestController extends AbstractController
{
    /**
     * @var ApartmentApplicationService
     */
    private $apartmentApplicationService;

    /**
     * ApartmentRestController constructor.
     * @param ApartmentApplicationService $apartmentApplicationService
     */
    public function __construct(ApartmentApplicationService $apartmentApplicationService)
    {
        $this->apartmentApplicationService = $apartmentApplicationService;
    }
//
//    #[Route('/apartment', name: 'apartment')]
    public function addApartment()
    {
        return $this->apartmentApplicationService->add();
    }

    public function add(

    ):void{

//        string $ownerId,
//        String $street,
//        string $postalCode,
//        string $houseNumber,
//        string $apartmentNumber,
//        string $city,
//        string $country,
//        string $description,
//        array $roomsDefinition
        $this->apartmentApplicationService->add();
    }



}