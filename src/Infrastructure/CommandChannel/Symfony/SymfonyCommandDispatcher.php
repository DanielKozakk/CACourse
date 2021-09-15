<?php

namespace Infrastructure\CommandChannel\Symfony;

use Application\Booking\AcceptBookingCommand;
use Application\Booking\RejectBookingCommand;
use Application\CommandChannel\CommandChannel;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class SymfonyCommandDispatcher implements CommandChannel
{
    private EventDispatcherInterface $commandDispatcher;

    /**
     * @param EventDispatcherInterface $commandDispatcher
     */
    public function __construct(EventDispatcherInterface $commandDispatcher)
    {
        $this->commandDispatcher = $commandDispatcher;
    }


    public function registerBookingRejectCommand(RejectBookingCommand $rejectBookingCommand)
    {
        $this->commandDispatcher->dispatch($rejectBookingCommand);
    }

    public function registerBookingAcceptedCommand(AcceptBookingCommand $acceptBookingCommand)
    {
        $this->commandDispatcher->dispatch($acceptBookingCommand);

    }
}