<?php

namespace Application\Booking;

use Domain\Apartment\Booking;
use Domain\Apartment\BookingRepository;
use Domain\EventChannel\EventChannel;

class BookingCommandHandler
{
    /**
     * @var BookingRepository
     */
    private BookingRepository $bookingRepository;

    /**
     * @var EventChannel
     */
    private EventChannel $eventChannel;

    /**
     * BookingCommandHandler constructor.
     * @param BookingRepository $bookingRepository
     * @param EventChannel $eventChannel
     */
    public function __construct(BookingRepository $bookingRepository, EventChannel $eventChannel)
    {
        $this->bookingRepository = $bookingRepository;
        $this->eventChannel = $eventChannel;
    }


    public function onBookingRejectCommand(RejectBookingCommand $bookingRejectCommand){

        /** @var Booking */
        $booking = $this->bookingRepository->findById($bookingRejectCommand->getBookingId());

        $booking->reject();

        $this->bookingRepository->save($booking);
    }

    public function onBookingAcceptCommand(AcceptBookingCommand $bookingAcceptCommand){
        $booking = $this->bookingRepository->findById($bookingAcceptCommand->getBookingId());
        $booking->accept($this->eventChannel);

        $this->bookingRepository->save($booking);
    }

}