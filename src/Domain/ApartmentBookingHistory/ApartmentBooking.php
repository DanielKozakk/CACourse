<?php


namespace App\Domain\ApartmentBookingHistory;


class ApartmentBooking
{
    private BookingStep $bookingStep;
    private \DateTime $dateTime;
    private string $getOwnerId;
    private string $getTenantId;
    private BookingPeriod $bookingPeriod;

    private function __construct(BookingStep $bookingStep,\DateTime $dateTime, string $getOwnerId, string $getTenantId, BookingPeriod $bookingPeriod){

        $this->bookingStep = $bookingStep;
        $this->getOwnerId = $getOwnerId;
        $this->getTenantId = $getTenantId;
        $this->bookingPeriod = $bookingPeriod;
        $this->dateTime = $dateTime;
    }

    public static function start(\DateTime $bookingCreationDateTime, BookingStep $bookingStep, string $ownerId, string $tenantId, BookingPeriod $bookingPeriod) : ApartmentBooking
    {
        return new ApartmentBooking($bookingStep, $bookingCreationDateTime, $ownerId, $tenantId, $bookingPeriod);
    }


}