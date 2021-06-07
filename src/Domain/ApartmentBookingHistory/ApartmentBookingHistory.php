<?php


namespace App\Domain\ApartmentBookingHistory;


class ApartmentBookingHistory
{

    /**
     * @var ApartmentBooking[]
     */
     private array $apartmentBookings;
    /**
     * @var string
     */
    private $apartmentId;

    /**
     * ApartmentBookingHistory constructor.
     * @param $apartmentId
     */
    public function __construct(string $apartmentId)
    {
        $this->apartmentId = $apartmentId;
    }

    public function add(ApartmentBooking $apartmentBooking)
    {
        $this->apartmentBookings[] = $apartmentBooking;
    }


}