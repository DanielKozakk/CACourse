<?php


namespace App\Domain\ApartmentBookingHistory;


class ApartmentBooking
{
    private BookingStep $bookingStep;
    private string $getOwnerId;
    private string $getTenantId;
    private BookingPeriod $bookingPeriod;

    private function __construct(BookingStep $bookingStep, string $getOwnerId, string $getTenantId, BookingPeriod $bookingPeriod){

        $this->bookingStep = $bookingStep;
        $this->getOwnerId = $getOwnerId;
        $this->getTenantId = $getTenantId;
        $this->bookingPeriod = $bookingPeriod;
    }

    public static function start(BookingStep $bookingStep, string $getOwnerId, string $getTenantId, BookingPeriod $bookingPeriod) : ApartmentBooking
    {

    }


}