<?php


namespace App\Infrastructure\EventChannel\Dispatcher;


use App\Domain\Apartment\ApartmentBookedEvent;
use App\Domain\Apartment\BookingAcceptedEvent;
use App\Domain\Event\EventChannel;
use App\Domain\HotelRoom\HotelBookedEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class StandardDispatcherEventChannel implements EventChannel
{
    private EventDispatcherInterface $eventDispatcher;

    /**
     * StandardDispatcherEventChannel constructor.
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function publishApartmentBooked(ApartmentBookedEvent $apartmentBooked)
    {
       $this->eventDispatcher->dispatch($apartmentBooked);
    }

    public function publishHotelRoomBooked(HotelBookedEvent $hotelRoomBooked)
    {
        $this->eventDispatcher->dispatch($hotelRoomBooked);
    }

    public function publishBookingAcceptedEvent(BookingAcceptedEvent $bookingAccepted)
    {
        $this->eventDispatcher->dispatch($bookingAccepted);
    }
}