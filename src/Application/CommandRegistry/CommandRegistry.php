<?php


namespace App\Application\CommandRegistry;


use App\Application\Booking\BookingRejectCommand;

interface CommandRegistry
{
    function register(BookingRejectCommand $command);

}