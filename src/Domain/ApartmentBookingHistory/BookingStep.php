<?php


namespace App\Domain\ApartmentBookingHistory;


class BookingStep
{

    private  const STATES = [self::START];

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