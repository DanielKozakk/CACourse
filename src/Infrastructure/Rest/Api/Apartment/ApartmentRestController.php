<?php

namespace Infrastructure\Rest\Api\Apartment;
use Application\Apartment\ApartmentApplicationService;
//use Query\Apartment\ApartmentDetails;
use Query\Apartment\ApartmentReadModel;
use Query\Apartment\QueryApartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ApartmentRestController extends AbstractController
{

    private ApartmentApplicationService $apartmentApplicationService;
    private QueryApartmentRepository $queryApartmentRepository;

    /**
     * @param ApartmentApplicationService $apartmentApplicationService
     * @param QueryApartmentRepository $queryApartmentRepository
     */
    public function __construct(ApartmentApplicationService $apartmentApplicationService, QueryApartmentRepository $queryApartmentRepository)
    {
        $this->apartmentApplicationService = $apartmentApplicationService;
        $this->queryApartmentRepository = $queryApartmentRepository;
    }

    #[Route('/apartment-rest', name: 'apartment-rest')]
    public function index(): Response
    {

//        $this->apartmentRepository->findById("124123");

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainCoasd asd ntroller.php',
        ]);
    }

//    public function add(ApartmentCreationDto $apartmentDto): void{
//        $this->apartmentApplicationService->addApartment(
//            $apartmentDto->getOwnerId(),
//            $apartmentDto->getStreet(),
//            $apartmentDto->getPostalCode(),
//            $apartmentDto->getHouseNumber(),
//            $apartmentDto->getApartmentNumber(),
//            $apartmentDto->getCity(),
//            $apartmentDto->getCountry(),
//            $apartmentDto->getDescription(),
//            $apartmentDto->getRoomsDefinition(),
//        );
//    }

    /// @Route /book/apartmentId
//    #[Route('/apartment-booking', name: 'apartment-booking')]
    public function book(string $apartmentId, ApartmentBookingDto $apartmentBookingDto): void{

        $this->apartmentApplicationService->book($apartmentId, $apartmentBookingDto->getTenantId(), $apartmentBookingDto->getStart(), $apartmentBookingDto->getEnd());
    }
//
//    /**
//     * @route /find_all
//     * @return array<ApartmentReadModel>
//     */
//    public function findAll(): array{
//        return $this->queryApartmentRepository->findAll();
//    }

    // /{id}
//    public function findById(string $id): ?ApartmentDetails{
//        return $this->queryApartmentRepository->findById($id);
//    }


}
