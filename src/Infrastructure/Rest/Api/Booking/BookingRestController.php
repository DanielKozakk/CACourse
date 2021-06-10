<?php


namespace App\Infrastructure\Rest\Api\Booking;


use App\Application\Booking\BookingRejectCommand;
use App\Application\CommandRegistry\CommandRegistry;

/**
 * Class BookingRestController
 * @package App\Infrastructure\Rest\Api\Booking
 * Dodaj do path /booking
 */
class BookingRestController
{
    private CommandRegistry $commandRegistry;

    /**
     * BookingRestController constructor.
     * @param CommandRegistry $commandRegistry
     */
    public function __construct(CommandRegistry $commandRegistry)
    {
        $this->commandRegistry = $commandRegistry;
    }
    /**
     * put method, /reject/{id}
     * TODO: uzupełnij config api
     *
     * @param string $id
     * @return BookingRejectCommand
     */
    public function reject(string $id): BookingRejectCommand
    {
        return $this->commandRegistry->register(new BookingRejectCommand($id));
    }

}