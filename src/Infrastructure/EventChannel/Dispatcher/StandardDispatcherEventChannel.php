<?php


namespace App\Infrastructure\EventChannel\Dispatcher;


use App\Domain\Apartment\ApartmentBookedEvent;
use App\Domain\Event\EventChannel;
use App\Domain\HotelRoom\HotelRoomBookedEvent;
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

    public function publishHotelRoomBooked(HotelRoomBookedEvent $hotelRoomBooked)
    {
        $this->eventDispatcher->dispatch($hotelRoomBooked);
    }
}