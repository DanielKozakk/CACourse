<?php

namespace Application\Hotel\HotelBookingHistory;
use Domain\Apartment\ApartmentBookedEvent;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBooking;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistoryRepository;
use Domain\Apartment\ApartmentBookingHistory\BookingPeriod;
use Domain\Hotel\HotelBookingHistory\HotelBookingHistoryRepository;
use Domain\Hotel\HotelBookingHistory\HotelRoomBooking;
use Domain\Hotel\HotelBookingHistory\HotelBookingHistory;
use Domain\Hotel\HotelRoom\HotelRoomBookedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class HotelBookingHistoryEventSubscriber implements EventSubscriberInterface
{

    private HotelBookingHistoryRepository $hotelBookingHistoryRepository;

    /**
     * @param HotelBookingHistoryRepository $hotelBookingHistoryRepository
     */
    public function __construct(HotelBookingHistoryRepository $hotelBookingHistoryRepository)
    {
        $this->hotelBookingHistoryRepository = $hotelBookingHistoryRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            HotelRoomBookedEvent::class => [
                ['book', 10]
            ],
        ];
    }

    public function book(HotelRoomBookedEvent $hotelRoomBookedEvent)
    {

        $hotelRoomBookingHistory = $this->findHotelRoomBookingHistoryForId($hotelRoomBookedEvent->getHotelId(), $hotelRoomBookedEvent->getHotelRoomId());

        $hotelRoomBookingHistory->add($hotelRoomBookedEvent->getHotelRoomId(), $hotelRoomBookedEvent->getEventCreationDateTime(), $hotelRoomBookedEvent->getTenantId(), $hotelRoomBookedEvent->getDays() );

        $this->hotelBookingHistoryRepository->save($hotelRoomBookingHistory);
    }
    private function findHotelRoomBookingHistoryForId(string $hotelId, string $hotelRoomId): HotelBookingHistory
    {
        if ($this->hotelBookingHistoryRepository->existsFor($hotelRoomId)) {
            return $this->hotelBookingHistoryRepository->findFor($hotelRoomId);
        } else {
            return new HotelBookingHistory($hotelId);
        }
    }
}
