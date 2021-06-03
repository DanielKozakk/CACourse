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

    public function addApartment(ApartmentDto $apartmentDto):void{

        $this->apartmentApplicationService->add($apartmentDto->getOwnerId(),
            $apartmentDto->getStreet(),
            $apartmentDto->getPostalCode(),
            $apartmentDto->getHouseNumber(),
            $apartmentDto->getApartmentNumber(),
            $apartmentDto->getCity(),
            $apartmentDto->getCountry(),
            $apartmentDto->getDescription(),
            $apartmentDto->getRoomsDefinition());
    }

    public function book(string $id, ApartmentBookingDto $apartmentBookingDto){

        $this->apartmentApplicationService->book($id, $apartmentBookingDto->getTenantId(), $apartmentBookingDto->getStart(), $apartmentBookingDto->getEnd());
    }
}