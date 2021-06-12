<?php


namespace App\Application\CommandRegistry;


use App\Application\Booking\BookingAcceptCommand;
use App\Application\Booking\BookingRejectCommand;

interface CommandRegistry
{
    function registerRejectCommand(BookingRejectCommand $command);
    function registerAcceptCommand(BookingAcceptCommand $command);

}