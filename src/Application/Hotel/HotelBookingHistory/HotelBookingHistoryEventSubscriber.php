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
use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use Infrastructure\Persistence\Doctrine\Hotel\HotelRoom\DoctrineHotelRoomRepository;
use Infrastructure\Persistence\Doctrine\Hotel\HotelRoomBookingHistory\DoctrineHotelRoomBookingHistoryRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class HotelBookingHistoryEventSubscriber implements EventSubscriberInterface
{

    private HotelBookingHistoryRepository $hotelBookingHistoryRepository;
    private DoctrineHotelRoomRepository $doctrineHotelRoomRepository;

    /**
     * @param HotelBookingHistoryRepository $hotelBookingHistoryRepository
     * @param DoctrineHotelRoomRepository $doctrineHotelRoomRepository
     */
    public function __construct(HotelBookingHistoryRepository $hotelBookingHistoryRepository, DoctrineHotelRoomRepository $doctrineHotelRoomRepository)
    {
        $this->hotelBookingHistoryRepository = $hotelBookingHistoryRepository;
        $this->doctrineHotelRoomRepository = $doctrineHotelRoomRepository;
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

        $hotelBookingHistory = $this->findHotelBookingHistoryForId($hotelRoomBookedEvent->getHotelId());

        $hotelBookingHistory->add($this->doctrineHotelRoomRepository->findById($hotelRoomBookedEvent->getHotelRoomId()), $hotelRoomBookedEvent->getEventCreationDateTime(), $hotelRoomBookedEvent->getTenantId(), $hotelRoomBookedEvent->getDays() );

        $this->hotelBookingHistoryRepository->save($hotelBookingHistory);
    }
    private function findHotelBookingHistoryForId(string $hotelId): HotelBookingHistory
    {
        if ($this->hotelBookingHistoryRepository->existsFor($hotelId)) {
            return $this->hotelBookingHistoryRepository->findFor($hotelId);
        } else {
            return new HotelBookingHistory($hotelId);
        }
    }
}
