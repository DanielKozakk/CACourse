<?php

namespace Domain\Apartment;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
//use Domain\EventChannel\EventChannel;

/**
 * @ORM\Entity
 */
class Booking
{

    /**
     * @var string
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private string $id;

    /**
     * @var RentalType
     * @ORM\Embedded
     */
    private RentalType $rentalType;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $rentalPlaceId;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $tenantId;

    /**
     * @var array
     * @ORM\Column(type="array")
     */
    private array $days;
    /**
     *
     * @ORM\Embedded
     */
    private BookingStatus $bookingStatus;

    /**
     * @param RentalType $rentalType
     * @param string $rentalPlaceId
     * @param string $tenantId
     * @param array $days
     */
    private function __construct(RentalType $rentalType, string $rentalPlaceId, string $tenantId, array $days)
    {
        $this->rentalType = $rentalType;
        $this->rentalPlaceId = $rentalPlaceId;
        $this->tenantId = $tenantId;
        $this->days = $days;
        $this->bookingStatus = BookingStatus::open();
    }


    public static function bookApartment(string $rentalPlaceId, string $tenantId, Period $period): Booking
    {
        return new Booking(RentalType::apartmentRentalType(),$rentalPlaceId, $tenantId, $period->asDateTimeArray());
    }
    public static function bookHotelRoom(string $rentalSpaceId, string $tenantId, array $days): Booking
    {
        return new Booking(RentalType::hotelRoomRentalType(), $rentalSpaceId, $tenantId, $days);
    }

    public function reject(){
        $this->bookingStatus = BookingStatus::rejected();
    }
//    public function accept(EventChannel $eventChannel){
//        $this->bookingStatus = BookingStatus::accept();
//        /**
//         * @var BookingAcceptedEvent
//         */
//        $bookingAcceptedEvent = BookingAcceptedEvent::create($this->rentalType, $this->rentalPlaceId, $this->tenantId, $this->days);
//
//        $eventChannel->publishBookingAcceptedEvent($bookingAcceptedEvent);
//
//    }

}