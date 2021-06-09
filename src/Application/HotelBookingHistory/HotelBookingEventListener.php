<?php


namespace App\Application\HotelBookingHistory;


use App\Domain\HotelRoom\HotelBookedEvent;
use App\Domain\HotelBookingHistory\HotelBooking;
use App\Domain\HotelBookingHistory\HotelBookingHistory;
use App\Domain\HotelBookingHistory\HotelBookingHistoryRepository;
use App\Domain\HotelBookingHistory\HotelBookingPeriod;

class HotelBookingEventListener
{

    /**
     * @var HotelBookingHistoryRepository
     */
    private HotelBookingHistoryRepository $hotelBookingRepository;

    public function onHotelRoomBooked(HotelBookedEvent $hotelBookedEvent){

        $hotelBookingHistory = $this->getBookingHistoryFor($hotelBookedEvent->getHotelId());

        $hotelBookingPeriod = new HotelBookingPeriod($hotelBookedEvent->getPeriodStart(), $hotelBookedEvent->getPeriodEnd());

        $hotelBookingHistory->add(
            HotelBooking::start(new \DateTime(),$hotelBookedEvent->getTenantId(), $hotelBookingPeriod)
        );

        $this->hotelBookingRepository->save($hotelBookingHistory);

    }

    private function getBookingHistoryFor(string $hotelId): HotelBookingHistory
    {
        $bookingHistory = $this->hotelBookingRepository->existFor($hotelId);

        if($bookingHistory){
            return $bookingHistory;
        } else {
            return new HotelBookingHistory();
        }
    }
}