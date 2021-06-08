<?php


namespace App\Domain\HotelRoomBookingHistory;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class HotelRoomBookingStep
{
    private const STATES = [self::START];

    public const START = 'START';

    /**
     * @var string
     */
    private string $state;

    /**
     * BookingStep constructor.
     * @param string $state
     */
    public function __construct(string $state)
    {
        if (in_array($state, self::STATES)){
            $this->state = $state;
        }
        else {
            throw new \InvalidArgumentException();
        }

    }
}