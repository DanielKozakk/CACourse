<?php


namespace App\Application\Booking;


use App\Domain\Apartment\Booking;
use App\Domain\Apartment\BookingRepository;
use App\Domain\Event\EventChannel;

class BookingCommandHandler
{
    /**
     * @var BookingRepository
     */
    private BookingRepository $bookingRepository;

    /**
     * @var EventChannel
     */
    private $eventChannel;

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


    public function onBookingRejectCommand(BookingRejectCommand $bookingRejectCommand){

        /** @var Booking */
        $booking = $this->bookingRepository->findById($bookingRejectCommand->getBookingId());

        $booking->reject();

        $this->bookingRepository->save($booking);
    }

    public function onBookingAcceptCommand(BookingAcceptCommand $bookingAcceptCommand){
        $booking = $this->bookingRepository->findById($bookingAcceptCommand->getBookingId());
        $booking->accept($this->eventChannel);

        $this->bookingRepository->save($booking);
    }

}