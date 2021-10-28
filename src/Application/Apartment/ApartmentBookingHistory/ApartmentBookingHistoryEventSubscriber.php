<?php

namespace Application\Apartment\ApartmentBookingHistory;

use Domain\Apartment\ApartmentBookedEvent;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBooking;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistoryRepository;
use Domain\Apartment\ApartmentBookingHistory\BookingPeriod;
use Domain\Apartment\ApartmentRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ApartmentBookingHistoryEventSubscriber implements EventSubscriberInterface
{
    private ApartmentBookingHistoryRepository $apartmentBookingHistoryRepository;
    private ApartmentRepository $apartmentRepository;

    /**
     * @param ApartmentBookingHistoryRepository $apartmentBookingHistoryRepository
     * @param ApartmentRepository $apartmentRepository
     */
    public function __construct(ApartmentBookingHistoryRepository $apartmentBookingHistoryRepository, ApartmentRepository $apartmentRepository)
{
    $this->apartmentBookingHistoryRepository = $apartmentBookingHistoryRepository;
    $this->apartmentRepository = $apartmentRepository;
}


    public static function getSubscribedEvents()
    {
        return [
            ApartmentBookedEvent::class => [
                ['consume', 10]
            ],
        ];
    }

    public function consume(ApartmentBookedEvent $apartmentBookedEvent)
    {

        $apartmentBookingHistory = $this->findApartmentBookingHistoryForId($apartmentBookedEvent->getApartmentId());

        $apartmentBookingHistory->add(
            ApartmentBooking::start(
                $apartmentBookedEvent->getCreationDateTime(),
                $apartmentBookedEvent->getOwnerId(),
                $apartmentBookedEvent->getTenantId(),
                new BookingPeriod($apartmentBookedEvent->getStartDate(), $apartmentBookedEvent->getEndDate()),
                $apartmentBookingHistory
            )
        );


        $this->apartmentBookingHistoryRepository->save($apartmentBookingHistory);

    }

    private function findApartmentBookingHistoryForId(int $apartmentId): ApartmentBookingHistory
    {

        if ($this->apartmentBookingHistoryRepository->existsFor($apartmentId)) {
            return $this->apartmentBookingHistoryRepository->findFor($apartmentId);
        } else {
            $apartment = $this->apartmentRepository->findById($apartmentId);
            return new ApartmentBookingHistory($apartment);
        }
    }
}