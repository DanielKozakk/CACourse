<?php

namespace Domain\Apartment;

use DateTime;
use Doctrine\ORM\Mapping as ORM;


//TODO: entity

/**
 * @ORM\Entity
 */
class Booking
{

    /**
     * @var string
     * @ORM\Id
     */
    private string $id;
    private RentalType $rentalType;
    private string $apartmentId;
    private string $tenantId;
    private array $days;
    private BookingStatus $bookingStatus;

    /**
     * @param RentalType $rentalType
     * @param string $apartmentId
     * @param string $tenantId
     * @param array $days
     */
    private function __construct(RentalType $rentalType, string $apartmentId, string $tenantId, array $days)
    {
        $this->rentalType = $rentalType;
        $this->apartmentId = $apartmentId;
        $this->tenantId = $tenantId;
        $this->days = $days;
        $this->bookingStatus = BookingStatus::open();
    }


    public static function bookApartment(string $rentalSpaceId, string $tenantId, Period $period): Booking
    {
        return new Booking(RentalType::apartmentRentalType(),$rentalSpaceId, $tenantId, $period->asDateTimeArray());
    }
    public static function bookHotelRoom(string $rentalSpaceId, string $tenantId, array $days): Booking
    {
        return new Booking(RentalType::hotelRoomRentalType(), $rentalSpaceId, $tenantId, $days);
    }

    public function reject(){
        $this->bookingStatus = BookingStatus::rejected();
    }
    public function accept(){
        $this->bookingStatus = BookingStatus::accept();
    }

}