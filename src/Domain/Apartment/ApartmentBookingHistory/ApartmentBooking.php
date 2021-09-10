<?php

namespace Domain\Apartment\ApartmentBookingHistory;

use DateTime;

class ApartmentBooking
{

    public const START_STEP = "START";



    public static function start(
        DateTime $bookingCreation,
        string $ownerId,
        string $tenantId,
        BookingPeriod $bookingPeriod
    )
    : ApartmentBooking {

        return new ApartmentBooking();
    }
}