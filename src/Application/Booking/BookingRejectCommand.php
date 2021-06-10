<?php


namespace App\Application\Booking;


class BookingRejectCommand
{

    private string $id;

    /**
     * BookingRejectCommand constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }


}