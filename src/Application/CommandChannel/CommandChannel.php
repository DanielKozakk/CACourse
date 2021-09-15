<?php

namespace Application\CommandChannel;

use Application\Booking\AcceptBookingCommand;
use Application\Booking\RejectBookingCommand;

interface CommandChannel
{

    public function registerBookingRejectCommand(RejectBookingCommand $bookingRejectCommand);
    public function registerBookingAcceptedCommand(AcceptBookingCommand $bookingRejectCommand);
}