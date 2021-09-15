<?php

namespace Application\CommandChannel;

use Application\Booking\BookingAcceptedCommand;
use Application\Booking\BookingRejectCommand;

interface CommandChannel
{

    public function registerBookingRejectCommand(BookingRejectCommand $bookingRejectCommand);
    public function registerBookingAcceptedCommand(BookingAcceptedCommand $bookingRejectCommand);
}