<?php

namespace Application\Hotel\HotelBookingHistory;
use Domain\Apartment\ApartmentBookedEvent;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBooking;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistoryRepository;
use Domain\Apartment\ApartmentBookingHistory\BookingPeriod;
use Domain\Hotel\HotelRoom\HotelRoomBookedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class HotelBookingHistoryEventSubscriber implements EventSubscriberInterface
{

    private HotelBookingHistoryRepository $hotelBookingHistoryRepository;

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

        $hotelRoomBookingHistory = $this->findHotelRoomBookingHistoryForId($hotelRoomBookedEvent->getHotelRoomId());

        $hotelRoomBookingHistory->add(
            HotelRoomBooking::start(
                $hotelRoomBookedEvent->getHotelRoomId(),
                $hotelRoomBookedEvent->getCreationDateTime(),
                $hotelRoomBookedEvent->getTenantId(),
                $hotelRoomBookedEvent->getDays()
            )
        );

        $this->hotelBookingHistoryRepository->save($hotelRoomBookingHistory);
    }
    private function findHotelRoomBookingHistoryForId(string $hotelRoomId): HotelRoomBookingHistory
    {

        if ($this->hotelBookingHistoryRepository->existsFor($hotelRoomId)) {
            return $this->hotelBookingHistoryRepository->findFor($hotelRoomId);
        } else {
            return new HotelRoomBookingHistory($hotelRoomId);
        }
    }
}
