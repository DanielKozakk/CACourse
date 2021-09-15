<?php

namespace Infrastructure\Rest\Api\Booking;

//TODO: https://api-platform.com/ - tutaj jest dokumentacja do tworzenia ładnego api do symfony.
// Route /booking
use Application\Booking\AcceptBookingCommand;
use Application\Booking\RejectBookingCommand;
use Application\CommandChannel\CommandChannel;

class BookingRestController
{

    private CommandChannel $commandChannel;


    // method put
    // route /reject/{id}
    /**
     * @param CommandChannel $commandChannel
     */
    public function __construct(CommandChannel $commandChannel)
    {
        $this->commandChannel = $commandChannel;
    }

    public function reject(string $id){
        $bookingRejectCommand = new RejectBookingCommand($id);
        $this->commandChannel->registerBookingRejectCommand($bookingRejectCommand);
    }

    public function accept(string $id){
        $this->commandChannel->registerBookingAcceptedCommand(new AcceptBookingCommand($id));
    }

}