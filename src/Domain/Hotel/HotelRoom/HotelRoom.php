<?php

namespace Domain\Hotel\HotelRoom;

class HotelRoom
{
    private string $hotelId;
    private int $hotelRoomNumber;
    /**
     * @var array<string, float> $spaces
     */
    private array $spaces;
    private string $description;

    public function __construct(string $hotelId, int $hotelRoomNumber, array $spaces, string $description)
    {
        $this->hotelId = $hotelId;
        $this->hotelRoomNumber = $hotelRoomNumber;
        $this->spaces = $spaces;
        $this->description = $description;
    }
}