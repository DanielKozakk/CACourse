<?php


namespace App\Infrastructure\Rest\Api\Apartment;


use App\Application\Apartment\ApartmentApplicationService;
use App\Query\Apartment\ApartmentReadModel;
use App\Query\Apartment\QueryApartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApartmentRestController extends AbstractController
{
    /**
     * @var ApartmentApplicationService
     */
    private ApartmentApplicationService $apartmentApplicationService;

    private QueryApartmentRepository $queryApartmentRepository;

    /**
     * ApartmentRestController constructor.
     * @param ApartmentApplicationService $apartmentApplicationService
     */
    public function __construct(ApartmentApplicationService $apartmentApplicationService, QueryApartmentRepository $queryApartmentRepository)
    {
        $this->apartmentApplicationService = $apartmentApplicationService;
        $this->queryApartmentRepository = $queryApartmentRepository;
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

    // TODO: getMethod, uzupełnij config do api

    /**
     * @return ApartmentReadModel[]
     */
    public function findAll() : array{
        return $this->queryApartmentRepository->findAll();
    }

}