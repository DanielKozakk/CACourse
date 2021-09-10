<?php

namespace Domain\Apartment\ApartmentBookingHistory;

use DateTime;

class ApartmentBooking
{

    public static function start(
        string $ownerId,
        string $tenantId,
        DateTime $startDate,
        DateTime $endDate)
    : ApartmentBooking {

        return new ApartmentBooking();
    }
}