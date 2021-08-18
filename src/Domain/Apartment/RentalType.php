<?php


namespace App\Domain\Apartment;



use InvalidArgumentException;

class RentalType
{

    public const APARTMENT = 'APARTMENT';
    public const HOTEL_ROOM = 'HOTEL_ROOM';

    public const RENTAL_TYPES = [
        self::APARTMENT, self::HOTEL_ROOM
    ];

    /**
     * @var string
     */
    private string $state;

    /**
     * BookingStep constructor.
     * @param string $state
     */
    public function __construct(string $state)
    {
        if(!in_array($state, self::RENTAL_TYPES)){
            throw new InvalidArgumentException();
        }
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->state;
    }

    public static function getApartmentRentalType(): RentalType
    {
        return new RentalType(self::APARTMENT);
    }

    public static function getHotelRoomRentalType(): RentalType
    {
        return new RentalType(self::HOTEL_ROOM);
    }

    public function isRentalTypeHotelRoom(): bool
    {
        return $this->getType() === self::HOTEL_ROOM;
    }

    public function isRentalTypeApartment(): bool
    {
        return $this->getType() === self::APARTMENT;

    }

}