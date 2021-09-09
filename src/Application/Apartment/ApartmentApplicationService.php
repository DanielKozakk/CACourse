<?php
declare(strict_types=1);
namespace Application\Apartment;

use DateTime;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentFactory;
use Domain\Apartment\ApartmentRepository;
use Domain\Apartment\Period;
use Domain\EventChannel\EventChannel;

class ApartmentApplicationService
{
    private ApartmentRepository $apartmentRepository;
    private EventChannel $eventChannel;

    /**
     * @param ApartmentRepository $apartmentRepository
     * @param EventChannel $eventChannel
     */
    public function __construct(ApartmentRepository $apartmentRepository, EventChannel $eventChannel)
    {
        $this->apartmentRepository = $apartmentRepository;
        $this->eventChannel = $eventChannel;
    }

    /**
     * @param string $ownerId
     * @param string $street
     * @param string $postalCode
     * @param string $houseNumber
     * @param string $apartmentNumber
     * @param string $city
     * @param string $country
     * @param string $description
     * @param array<string, double> $roomsDefinition
     * @return void
     */
    public function addApartment(
        string $ownerId,
        string $street,
        string $postalCode,
        string $houseNumber,
        string $apartmentNumber,
        string $city,
        string $country,
        string $description,
        array  $roomsDefinition) : void
    {
        $newApartment= (new ApartmentFactory())->create(
        $ownerId,
        $street,
        $postalCode,
        $houseNumber,
        $apartmentNumber,
        $city,
        $country,
        $description,
        $roomsDefinition);

        $this->apartmentRepository->save($newApartment);
    }

    public function book(string $apartmentId, string $tenantId, DateTime $start, DateTime $end){

        /**
         * @var Apartment
         */
        $apartment = $this->apartmentRepository->findById($apartmentId);

        /**
         * @var Period
         */
        $period = new Period($start, $end);

        $apartment->book($tenantId, $period, $this->eventChannel);

    }
}