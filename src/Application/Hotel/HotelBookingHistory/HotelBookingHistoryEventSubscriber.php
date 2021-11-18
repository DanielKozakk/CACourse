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
use Domain\Hotel\HotelRepository;
use Domain\Hotel\HotelRoom\HotelRoomBookedEvent;
use Domain\Hotel\HotelRoom\HotelRoomRepository;
use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use Infrastructure\Persistence\Doctrine\Hotel\HotelRoom\DoctrineHotelRoomRepository;
use Infrastructure\Persistence\Doctrine\Hotel\HotelRoomBookingHistory\DoctrineHotelRoomBookingHistoryRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class HotelBookingHistoryEventSubscriber implements EventSubscriberInterface
{

    private HotelBookingHistoryRepository $hotelBookingHistoryRepository;
    private HotelRoomRepository $doctrineHotelRoomRepository;
    private HotelRepository $doctrineHotelRepository;

    /**
     * @param HotelBookingHistoryRepository $hotelBookingHistoryRepository
     * @param HotelRoomRepository $doctrineHotelRoomRepository
     * @param HotelRepository $doctrineHotelRepository
     */
    public function __construct(HotelBookingHistoryRepository $hotelBookingHistoryRepository, HotelRoomRepository $doctrineHotelRoomRepository, HotelRepository $doctrineHotelRepository)
    {
        $this->hotelBookingHistoryRepository = $hotelBookingHistoryRepository;
        $this->doctrineHotelRoomRepository = $doctrineHotelRoomRepository;
        $this->doctrineHotelRepository = $doctrineHotelRepository;
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

        $hotelRoom = $this->doctrineHotelRoomRepository->findById($hotelRoomBookedEvent->getHotelRoomId());
        $hotelBookingHistory = $this->findHotelBookingHistoryForId($hotelRoomBookedEvent->getHotelId());

        $hotelBookingHistory->add( $hotelRoom, $hotelRoomBookedEvent->getEventCreationDateTime(), $hotelRoomBookedEvent->getTenantId(), $hotelRoomBookedEvent->getDays() );

        $this->hotelBookingHistoryRepository->save($hotelBookingHistory);
    }
    private function findHotelBookingHistoryForId(string $hotelId): HotelBookingHistory
    {
        if ($this->hotelBookingHistoryRepository->existsFor($hotelId)) {
            return $this->hotelBookingHistoryRepository->findFor($hotelId);
        } else {
            return new HotelBookingHistory($this->doctrineHotelRepository->findById($hotelId));
        }
    }
}
