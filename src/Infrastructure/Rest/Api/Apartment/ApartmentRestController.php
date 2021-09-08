<?php

namespace Infrastructure\Rest\Api\Apartment;

use Application\Apartment\ApartmentApplicationService;

//TODO: https://api-platform.com/ - tutaj jest dokumentacja do tworzenia ładnego api do symfony.
// Nie jestem pewien, czy tworzy się tam takie kontrollery - dostosuj funkcjonalność tej klasy do powyższego frameworka, gdy już będziesz chciał używac funkcjonalności.
class ApartmentRestController
{

    private ApartmentApplicationService $apartmentApplicationService;

    /**
     * @param ApartmentApplicationService $apartmentApplicationService
     */
    public function __construct(ApartmentApplicationService $apartmentApplicationService)
    {
        $this->apartmentApplicationService = $apartmentApplicationService;
    }

    public function add(ApartmentCreationDto $apartmentDto): void{
        $this->apartmentApplicationService->addApartment(
            $apartmentDto->getOwnerId(),
            $apartmentDto->getStreet(),
            $apartmentDto->getPostalCode(),
            $apartmentDto->getHouseNumber(),
            $apartmentDto->getApartmentNumber(),
            $apartmentDto->getCity(),
            $apartmentDto->getCountry(),
            $apartmentDto->getDescription(),
            $apartmentDto->getRoomsDefinition(),
        );
    }

    /// @Route /book/apartmentId
    public function book(string $apartmentId, ApartmentBookingDto $apartmentBookingDto): void{

        $this->apartmentApplicationService->book($apartmentId, $apartmentBookingDto->getTenantId(), $apartmentBookingDto->getStart(), $apartmentBookingDto->getEnd());
    }
}
