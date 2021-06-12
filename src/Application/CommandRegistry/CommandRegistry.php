<?php


namespace App\Application\CommandRegistry;


use App\Application\Booking\BookingAcceptCommand;
use App\Application\Booking\BookingRejectCommand;

interface CommandRegistry
{
    function registerRejectCommand(BookingRejectCommand $bookingRejectCommand);
    function registerAcceptCommand(BookingAcceptCommand $bookingAcceptCommand);

}