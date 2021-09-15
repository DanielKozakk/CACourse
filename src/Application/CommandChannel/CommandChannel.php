<?php

namespace Application\CommandChannel;

use Application\Booking\AcceptBookingCommand;
use Application\Booking\RejectBookingCommand;

interface CommandChannel
{
    public function registerBookingRejectCommand(RejectBookingCommand $rejectBookingCommand);
    public function registerBookingAcceptedCommand(AcceptBookingCommand $acceptBookingCommand);
}