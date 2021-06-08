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
            HotelRoomBooking::start(new \DateTime(), )

        );
//        $apartmentBookingHistory->add(
//            ApartmentBooking::start(
//                $apartmentBookedEvent->getCreationDateTime(),
//                new BookingStep(BookingStep::START),
//                $apartmentBookedEvent->getOwnerId(),
//                $apartmentBookedEvent->getTenantId(),
//                $bookingPeriod
//            )
//        );
//
//        $this->apartmentBookingHistoryRepository->save($apartmentBookingHistory);

    }

    private function getBookingHistoryFor(string $hotelId){

        $bookingHistory = $this->hotelRoomBookingRepository->existFor($hotelId);

        if($bookingHistory){
            return $bookingHistory;
        } else {
            return new HotelRoomBookingHistory();
        }
    }
}