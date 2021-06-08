<?php


namespace App\Application\HotelRoomBookingHistory;


use App\Domain\HotelRoom\HotelRoomBookedEvent;
use App\Domain\HotelRoomBookingHistory\HotelRoomBooking;
use App\Domain\HotelRoomBookingHistory\HotelRoomBookingHistory;
use App\Domain\HotelRoomBookingHistory\HotelRoomBookingHistoryRepository;
use App\Domain\HotelRoomBookingHistory\HotelRoomBookingPeriod;

class HotelRoomBookingEventListener
{

    /**
     * @var HotelRoomBookingHistoryRepository
     */
    private HotelRoomBookingHistoryRepository $hotelRoomBookingRepository;

    public function onHotelRoomBooked(HotelRoomBookedEvent $hotelRoomBookedEvent){

        $hotelRoomBookingHistory = $this->getBookingHistoryFor($hotelRoomBookedEvent->getHotelId());

        $hotelRoomBookingPeriod = new HotelRoomBookingPeriod($hotelRoomBookedEvent->getPeriodStart(), $hotelRoomBookedEvent->getPeriodEnd());

        $hotelRoomBookingHistory->add(
            HotelRoomBooking::start(new \DateTime(),$hotelRoomBookedEvent->getTenantId(), $hotelRoomBookingPeriod)
        );

        $this->hotelRoomBookingRepository->save($hotelRoomBookingHistory);

    }

    private function getBookingHistoryFor(string $hotelId): HotelRoomBookingHistory
    {
        $bookingHistory = $this->hotelRoomBookingRepository->existFor($hotelId);

        if($bookingHistory){
            return $bookingHistory;
        } else {
            return new HotelRoomBookingHistory();
        }
    }
}