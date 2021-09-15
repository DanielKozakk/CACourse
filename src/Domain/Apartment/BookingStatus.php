<?php

namespace Domain\Apartment;
//TODO: embedable
class BookingStatus
{
    public static string $OPEN = 'OPEN';
    public static string $REJECTED = 'REJECTED';
    public static string $ACCEPT = 'ACCEPT';

    /**
     * @var string
     */
    private string $state;


    /**
     * BookingStatus constructor.
     * @param string $state
     */
    private function __construct(string $state)
    {
        $this->state = $state;
    }

    public static function open() : BookingStatus{
        return new BookingStatus(self::$OPEN);
    }
    public static function rejected() : BookingStatus{
        return new BookingStatus(self::$REJECTED);
    }
    public static function accept() : BookingStatus{
        return new BookingStatus(self::$ACCEPT);
    }
    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }
}