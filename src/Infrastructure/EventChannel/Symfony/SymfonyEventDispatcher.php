<?php

namespace Infrastructure\EventChannel\Symfony;

use Domain\Apartment\ApartmentBookedEvent;
use Domain\EventChannel\EventChannel;
use Domain\Hotel\HotelRoom\HotelRoomBookedEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class SymfonyEventDispatcher implements EventChannel
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
    public function publishApartmentBookedEvent(ApartmentBookedEvent $apartmentBookedEvent)
    {
        $this->eventDispatcher->dispatch($apartmentBookedEvent);
    }

    public function publishHotelRoomBookedEvent(HotelRoomBookedEvent $hotelRoomBookedEvent)
    {
        $this->eventDispatcher->dispatch($hotelRoomBookedEvent);
    }
}
