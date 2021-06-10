<?php


namespace App\Application\HotelBookingHistory;


use App\Domain\HotelRoom\HotelBookedEvent;
use App\Domain\HotelBookingHistory\HotelBookingHistory;
use App\Domain\HotelBookingHistory\HotelBookingHistoryRepository;

class HotelBookingEventListener
{

    /**
     * @var HotelBookingHistoryRepository
     */
    private HotelBookingHistoryRepository $hotelBookingHistoryRepository;

    /**
     * HotelBookingEventListener constructor.
     * @param HotelBookingHistoryRepository $hotelBookingHistoryRepository
     */
    public function __construct(HotelBookingHistoryRepository $hotelBookingHistoryRepository)
    {
        $this->hotelBookingHistoryRepository = $hotelBookingHistoryRepository;
    }

    public function onHotelRoomBooked(HotelBookedEvent $hotelBookedEvent){

        $hotelBookingHistory = $this->getBookingHistoryForHotelBookedEvent($hotelBookedEvent);

        $hotelBookingHistory->add($hotelBookedEvent->getHotelRoomId(), $hotelBookedEvent->getHotelRoomBookedCreationTime(), $hotelBookedEvent->getTenantId(), $hotelBookedEvent->getPeriodStart(), $hotelBookedEvent->getPeriodEnd());

        $this->hotelBookingHistoryRepository->save($hotelBookingHistory);
    }

    private function getBookingHistoryForHotelBookedEvent(HotelBookedEvent $hotelBookedEvent): HotelBookingHistory
    {
        if($this->hotelBookingHistoryRepository->existFor($hotelBookedEvent->getHotelId())){
            return $this->hotelBookingHistoryRepository->findFor($hotelBookedEvent->getHotelId());
        } else {
            return new HotelBookingHistory();
        }
    }
}