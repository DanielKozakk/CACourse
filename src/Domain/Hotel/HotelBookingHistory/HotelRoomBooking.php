<?php

namespace Domain\Hotel\HotelBookingHistory;

use DateTime;

class HotelRoomBooking
{


    public static function start(string $hotelRoomId, DateTime $eventCreationDateTime, string $tenantId, array $days) : HotelRoomBooking{


        return new HotelRoomBooking();
    }

}