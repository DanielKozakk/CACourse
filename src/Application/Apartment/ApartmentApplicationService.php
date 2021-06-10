<?php


namespace App\Application\Apartment;

use App\Domain\Apartment\ApartamentFactory;
use App\Domain\Apartment\ApartmentRepository;
use App\Domain\Apartment\Booking;
use App\Domain\Apartment\BookingRepository;
use App\Domain\Apartment\Period;
use App\Domain\Event\EventChannel;
use DateTime;


class ApartmentApplicationService
{
    /**
     * @var ApartmentRepository
     */
    private ApartmentRepository $apartmentRepository;

    /**
     * @var EventChannel
     */
    private EventChannel $eventChannel;

    /**
     * @var BookingRepository
     */
    private BookingRepository $bookingRepository;

    /**
     * ApartmentApplicationService constructor.
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


    public function add(
        string $ownerId,
        String $street,
        string $postalCode,
        string $houseNumber,
        string $apartmentNumber,
        string $city,
        string $country,
        string $description,
        array $roomsDefinition
    ) : void{
        $apartment = (new ApartamentFactory())->create($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country, $roomsDefinition, $ownerId, $description);

        $this->apartmentRepository->save($apartment);
    }

    public function book(string $id, string $tenantId, DateTime $start, DateTime $end)
    {
        $apartment = $this->apartmentRepository->findById($id);

        /**
         * @var Period
         */
        $period = new Period($start, $end);

        /**
         * @var Booking
         */
         $booking = $apartment->book($tenantId, $period, $this->eventChannel);
    }
}