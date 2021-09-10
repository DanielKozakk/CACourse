<?php

namespace Application\Apartment\ApartmentBookingHistory;

use Domain\Apartment\ApartmentBookedEvent;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBooking;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistoryRepository;
use Domain\Apartment\ApartmentBookingHistory\BookingPeriod;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ApartmentBookingHistoryEventSubscriber implements EventSubscriberInterface
{

    private ApartmentBookingHistoryRepository $apartmentBookingHistoryRepository;

    /**
     * @param ApartmentBookingHistoryRepository $apartmentBookingHistoryRepository
     */
    public function __construct(ApartmentBookingHistoryRepository $apartmentBookingHistoryRepository)
    {
        $this->apartmentBookingHistoryRepository = $apartmentBookingHistoryRepository;
    }


    public static function getSubscribedEvents()
    {
        return [
            ApartmentBookedEvent::class => [
                ['book', 10]
            ],
        ];
    }

    public function book(ApartmentBookedEvent $apartmentBookedEvent)
    {

        /**
         * @var ApartmentBookingHistory $apartmentBookingHistory
         */
        $apartmentBookingHistory = $this->findApartmentBookingHistoryForId($apartmentBookedEvent->getApartmentId());

        $apartmentBookingHistory->add(
            ApartmentBooking::start(
                $apartmentBookedEvent->getOwnerId(),
                $apartmentBookedEvent->getTenantId(),
                new BookingPeriod($apartmentBookedEvent->getStartDate(), $apartmentBookedEvent->getEndDate())
            )
        );
    }

    private function findApartmentBookingHistoryForId(string $apartmentId) : ApartmentBookingHistory{

        if($this->apartmentBookingHistoryRepository->existsFor($apartmentId)){
            return $this->apartmentBookingHistoryRepository->findFor($apartmentId);
        } else {
            return  new ApartmentBookingHistory($apartmentId);
        }
    }

}