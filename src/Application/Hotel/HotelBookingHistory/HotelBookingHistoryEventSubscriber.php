<?php

namespace Application\Hotel\HotelBookingHistory;
use Domain\Hotel\HotelBookingHistory\HotelBookingHistoryRepository;
use Domain\Hotel\HotelBookingHistory\HotelBookingHistory;
use Domain\Hotel\HotelRepository;
use Domain\Hotel\HotelRoom\HotelRoom;
use Domain\Hotel\HotelRoom\HotelRoomBookedEvent;
use Infrastructure\Persistence\Helper\PropertiesUnwrapper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class HotelBookingHistoryEventSubscriber implements EventSubscriberInterface
{
    private HotelBookingHistoryRepository $hotelBookingHistoryRepository;
    private HotelRepository $doctrineHotelRepository;

    /**
     * @param HotelBookingHistoryRepository $hotelBookingHistoryRepository
     * @param HotelRepository $doctrineHotelRepository
     */
    public function __construct(HotelBookingHistoryRepository $hotelBookingHistoryRepository, HotelRepository $doctrineHotelRepository)
    {
        $this->hotelBookingHistoryRepository = $hotelBookingHistoryRepository;
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
        $hotelRoom =  $this->doctrineHotelRepository->findHotelRoomById($hotelRoomBookedEvent->getHotelRoomId());
        $hotelBookingHistory = $this->findHotelBookingHistoryForId($hotelRoomBookedEvent->getHotelId());

        $hotelBookingHistory->add($hotelRoom, $hotelRoomBookedEvent->getEventCreationDateTime(), $hotelRoomBookedEvent->getTenantId(), $hotelRoomBookedEvent->getDays() );

        $this->hotelBookingHistoryRepository->save($hotelBookingHistory);
    }
    private function findHotelBookingHistoryForId(string $hotelId): HotelBookingHistory
    {
        if ($this->hotelBookingHistoryRepository->existsFor($hotelId)) {
            return $this->hotelBookingHistoryRepository->findFor($hotelId);
        } else {
            return new HotelBookingHistory($this->doctrineHotelRepository->findHotelById($hotelId));
        }
    }
}
