<?php


namespace App\Application\ApartmentBookingHistory;


use App\Domain\Apartment\ApartmentBookedEvent;
use App\Domain\ApartmentBookingHistory\ApartmentBooking;
use App\Domain\ApartmentBookingHistory\ApartmentBookingHistory;
use App\Domain\ApartmentBookingHistory\ApartmentBookingHistoryRepository;
use App\Domain\ApartmentBookingHistory\BookingPeriod;

class ApartmentBookingHistoryEventListener
{
    /**
     * @var ApartmentBookingHistoryRepository;
     */
    private $apartmentBookingHistoryRepository;

    /**
     * ApartmentBookingHistoryEventListener constructor.
     * @param ApartmentBookingHistoryRepository $apartmentBookingHistoryRepository
     */
    public function __construct(ApartmentBookingHistoryRepository $apartmentBookingHistoryRepository)
    {
        $this->apartmentBookingHistoryRepository = $apartmentBookingHistoryRepository;
    }

    public function onApartmentBooked(ApartmentBookedEvent $apartmentBookedEvent)
    {
        /** @var ApartmentBookingHistory */
        $apartmentBookingHistory = $this->getApartmentBookingHistoryFor($apartmentBookedEvent->getApartmentId());

        /** @var BookingPeriod */
        $bookingPeriod = new BookingPeriod($apartmentBookedEvent->getPeriodStart(), $apartmentBookedEvent->getPeriodEnd());

        $apartmentBookingHistory->add(
            ApartmentBooking::start(
                $apartmentBookedEvent->getCreationDateTime(),
                $apartmentBookedEvent->getOwnerId(),
                $apartmentBookedEvent->getTenantId(),
                $bookingPeriod
            )
        );

        $this->apartmentBookingHistoryRepository->save($apartmentBookingHistory);
    }

    private function getApartmentBookingHistoryFor(string $apartmentId): ApartmentBookingHistory
    {
        if ($this->apartmentBookingHistoryRepository->existFor($apartmentId)) {
            return $this->apartmentBookingHistoryRepository->findFor($apartmentId);
        } else {
            return new ApartmentBookingHistory($apartmentId);
        }
    }
}