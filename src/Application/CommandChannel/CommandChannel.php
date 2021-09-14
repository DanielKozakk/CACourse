<?php

namespace Application\CommandChannel;

use Application\Booking\BookingRejectCommand;

interface CommandChannel
{

    public function register(BookingRejectCommand $bookingRejectCommand);
}