<?php


namespace App\Infrastructure\Event\Dispatcher;


use App\Domain\Apartment\ApartmentBooked;
use App\Domain\Event\EventChannel;
use App\Domain\HotelRoom\HotelRoomBooked;
use Symfony\Component\EventDispatcher\EventDispatcher;

class StandardDispatcherEventChannel implements EventChannel
{

    private EventDispatcher $eventDispatcher;

    /**
     * StandardDispatcherEventChannel constructor.
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }


    public function publishApartmentBooked(ApartmentBooked $apartmentBooked)
    {
       $this->eventDispatcher->dispatch($apartmentBooked);
    }

    public function publishHotelRoomBooked(HotelRoomBooked $apartmentBooked)
    {
        // TODO: Implement publishHotelRoomBooked() method.
    }
}