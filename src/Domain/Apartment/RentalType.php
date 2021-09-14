<?php

namespace Domain\Apartment;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class RentalType
{
    public static string $APARTMENT = 'APARTMENT';
    public static string $HOTEL_ROOM = 'HOTEL_ROOM';

    /**
     * @var string
     */
    private string $state;

    public static function apartmentRentalType() : RentalType{
        return new RentalType(self::$APARTMENT);
    }
    public static function hotelRoomRentalType() : RentalType{
        return new RentalType(self::$HOTEL_ROOM);
    }

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


}