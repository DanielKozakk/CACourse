<?php

namespace Infrastructure\Rest\Api\Apartment;

use Application\Apartment\ApartmentApplicationService;
use Query\Apartment\ApartmentDetails;
use Query\Apartment\ApartmentReadModel;
use Query\Apartment\QueryApartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/api/apartment/add', methods: ['POST'])]

    public function add(Request $request): Response
    {
        $apartmentDto = $request->request->all()['ApartmentCreationDto'];

        $id = $this->apartmentApplicationService->addApartment(
            $apartmentDto['ownerId'],
            $apartmentDto['street'],
            $apartmentDto['postalCode'],
            $apartmentDto['houseNumber'],
            $apartmentDto['apartmentNumber'],
            $apartmentDto['city'],
            $apartmentDto['country'],
            $apartmentDto['description'],
            $apartmentDto['roomsDefinition'],
        );

        return new Response($id, 201);
    }

    #[Route('/api/apartment/book/{apartmentId}', methods: ['PUT'])]
    public function book(string $apartmentId, Request $request): Response
    {

        return new Response('test completed');

//        /** @var ApartmentBookingDto $apartmentBookingDto */
//        $apartmentBookingDto = $request->request->get('apartmentBookingDto');
//
//        $this->apartmentApplicationService->book($apartmentId, $apartmentBookingDto->getTenantId(), $apartmentBookingDto->getStart(), $apartmentBookingDto->getEnd());
    }
//
//    /**
//     * @route /find_all
//     * @return array<ApartmentReadModel>
//     */
//    public function findAll(): array{
//        return $this->queryApartmentRepository->findAll();
//    }

    #[Route('/api/apartment/find/{apartmentId}', methods: ['GET'])]
    public function findById(string $apartmentId): Response
    {
        return $this->json($this->queryApartmentRepository->findById($apartmentId));
    }


}
