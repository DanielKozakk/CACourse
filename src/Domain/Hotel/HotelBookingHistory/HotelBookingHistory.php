<?php

namespace Domain\Hotel\HotelBookingHistory;

class HotelBookingHistory
{

    private string $hotelId;
    private string $hotelRoomId;

    /**
     * @param string $hotelId
     * @param string $hotelRoomId
     */
    public function __construct(string $hotelId, string $hotelRoomId)
    {
        $this->hotelId = $hotelId;
        $this->hotelRoomId = $hotelRoomId;
    }


    public function add (HotelRoomBooking $hotelRoomBooking){

    }
}