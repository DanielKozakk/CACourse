<?php


namespace App\Infrastructure\EventChannel\Dispatcher;


use App\Domain\Apartment\ApartmentBookedEvent;
use App\Domain\Event\EventChannel;
use App\Domain\HotelRoom\HotelRoomBookedEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\KernelEvents;

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


    public function publishApartmentBooked(ApartmentBookedEvent $apartmentBooked)
    {
       $this->eventDispatcher->dispatch($apartmentBooked);
    }

    public function publishHotelRoomBooked(HotelRoomBookedEvent $hotelRoomBooked)
    {
        $this->eventDispatcher->dispatch($hotelRoomBooked);
    }
}