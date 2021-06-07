<?php


namespace App\Application\ApartmentBookingHistoryEventListener;


use App\Domain\Apartment\ApartmentBookedEvent;
use App\Domain\ApartmentBookingHistory\ApartmentBooking;
use App\Domain\ApartmentBookingHistory\ApartmentBookingHistory;
use App\Domain\ApartmentBookingHistory\ApartmentBookingHistoryRepository;

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


    public function onApartmentBooked(ApartmentBookedEvent $apartmentBookedEvent){

        /** @var ApartmentBookingHistory */
        $apartmentBookingHistory = $this->getApartmentBookingHistoryFor($apartmentBookedEvent->getApartmentId());

        $apartmentBookingHistory->add(
            ApartmentBooking::start(
                $apartmentBookedEvent->getOwnerId(),
                $apartmentBookedEvent->getTenantId(),
                $apartmentBookedEvent->getPeriodStart(),
                $apartmentBookedEvent->getPeriodEnd(),
            )
        );

        $this->apartmentBookingHistoryRepository->save($apartmentBookingHistory);
    }

    private function getApartmentBookingHistoryFor(String $apartmentId) : ApartmentBookingHistory {

        if($this->apartmentBookingHistoryRepository->existFor($apartmentId)){
            return $this->apartmentBookingHistoryRepository->findFor($apartmentId);
        } else {
            return new ApartmentBookingHistory($apartmentId);
        }
    }
}