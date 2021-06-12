<?php


namespace App\Domain\Apartment;


use JetBrains\PhpStorm\Pure;

class RentalType
{

    private const APARTMENT = 'APARTMENT';
    private const HOTEL_ROOM = 'HOTEL_ROOM';

    /**
     * @var string
     */
    private string $state;

    /**
     * BookingStep constructor.
     * @param string $state
     */
    private function __construct(string $state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    public static function getApartmentRenatlType(): RentalType
    {
        return new RentalType(self::APARTMENT);
    }

    public static function getHotelRoomRentalType(): RentalType
    {
        return new RentalType(self::HOTEL_ROOM);
    }

}