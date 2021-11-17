<?php
declare(strict_types=1);
namespace Application\Apartment;

use DateTime;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentFactory;
use Domain\Apartment\ApartmentRepository;
use Domain\Apartment\Booking;
use Domain\Apartment\BookingRepository;
use Domain\Apartment\Period;
use Domain\EventChannel\EventChannel;

class ApartmentApplicationService
{
    private ApartmentRepository $apartmentRepository;
    private EventChannel $eventChannel;
    private BookingRepository $bookingRepository;

    /**
     * @param ApartmentRepository $apartmentRepository
     * @param EventChannel $eventChannel
     * @param BookingRepository $bookingRepository
     */
    public function __construct(ApartmentRepository $apartmentRepository, EventChannel $eventChannel, BookingRepository $bookingRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
        $this->eventChannel = $eventChannel;
        $this->bookingRepository = $bookingRepository;
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
        array  $roomsDefinition) : int
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

       return $this->apartmentRepository->save($newApartment);
    }

    public function book(int $apartmentId, string $tenantId, DateTime $start, DateTime $end){

        /**
         * @var Apartment
         */
        $apartment = $this->apartmentRepository->findById($apartmentId);

        /**
         * @var Period
         */
        $period = new Period($start, $end);

        /**
         * @var Booking
         */
        $booking = $apartment->book($tenantId, $period, $this->eventChannel);

        $this->bookingRepository->save($booking);
    }
}