<?php


namespace App\Infrastructure\CommandChannel\Dispatcher;

use App\Application\Booking\BookingAcceptCommand;
use App\Application\Booking\BookingRejectCommand;
use App\Application\CommandRegistry\CommandRegistry;
use App\Domain\Apartment\ApartmentBookedEvent;
use App\Domain\Event\EventChannel;
use App\Domain\HotelRoom\HotelBookedEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class StandardDispatcherCommandChannel implements CommandRegistry
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

    public function registerRejectCommand(BookingRejectCommand $bookingRejectCommand)
    {
       $this->eventDispatcher->dispatch($bookingRejectCommand);
    }

    /**
     * @param BookingAcceptCommand $bookingAcceptCommand
     */
    public function registerAcceptCommand(BookingAcceptCommand $bookingAcceptCommand)
    {
        $this->eventDispatcher->dispatch($bookingAcceptCommand);
    }
}