<?php


namespace App\Domain\Apartment;

use Doctrine\ORM\Mapping\Embeddable;

/**
 * Class BookingStatus
 * @package App\Domain\Apartment
 * @Embeddable
 */
class BookingStatus
{
    private const OPEN = 'OPEN';
    private const REJECTED = 'REJECTED';

    /**
     * @var string
     */
    private string $state;

    /**
     * BookingStep constructor.
     * @param string $state
     */
    private function __construct(string $state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    public static function getOpenBookingStatus()
    {
        return new BookingStatus(self::OPEN);
    }

    public function setRejectedBookingStatus(): self{
        $this->state = self::REJECTED;
        return $this;
    }

}