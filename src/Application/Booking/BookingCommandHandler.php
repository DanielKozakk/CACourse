<?php


namespace App\Application\Booking;


use App\Domain\Apartment\Booking;
use App\Domain\Apartment\BookingRepository;

class BookingCommandHandler
{
    /**
     * @var BookingRepository
     */
    private BookingRepository $bookingRepository;

    /**
     * BookingCommandHandler constructor.
     * @param BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function onBookingRejectCommand(BookingRejectCommand $bookingRejectCommand){

        /** @var Booking */
        $booking = $this->bookingRepository->findById($bookingRejectCommand->getBookingId());

        $booking->reject();

        $this->bookingRepository->save($booking);
    }

    public function onBookingAcceptCommand(BookingAcceptCommand $bookingAcceptCommand){

    }


}