<?php


namespace App\Domain\Apartment;


use App\Domain\Event\EventChannel;
use DatePeriod;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Booking
 * @package App\Domain\Apartment
 * @ORM\Entity
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    private string $id;

    /**
     * @ORM\Column(type="string")
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
     * @ORM\Column(type="array")
     * @var DatePeriod[]
     */
    private array $days;

    /**
     * @var BookingStatus
     * @ORM\Embedded(class="BookingStatus")
     */
    private BookingStatus $bookingStatus;

    private ApartmentRepository $apartmentRepository;

    /**
     * Booking constructor.
     * @param RentalType $rentalType
     * @param string $rentalPlaceId
     * @param string $tenantId
     * @param DateTime[] $days
     */
    private function __construct(RentalType $rentalType, string $rentalPlaceId, string $tenantId, array $days,)
    {
        $this->rentalType = $rentalType;
        $this->rentalPlaceId = $rentalPlaceId;
        $this->tenantId = $tenantId;
        $this->days = $days;
    }

    public static function apartment(string $rentalPlaceId, string $tenantId, Period $period): Booking
    {
        /** @var DatePeriod[] */
        $days = [$period->asDateTimeArray()];

        return new Booking(RentalType::getApartmentRenatlType(), $rentalPlaceId, $tenantId, $days);
    }

    public static function hotelRoom(int $rentalPlaceId, $tenantId, array $days): Booking
    {
        return new Booking(RentalType::getHotelRoomRentalType(), $rentalPlaceId, $tenantId, $days);
    }

    public function reject()
    {
        $this->bookingStatus->setRejectedBookingStatus();
    }

    public function accept(EventChannel $eventChannel)
    {
        $this->bookingStatus->setAcceptedBookingStatus();

        $eventChannel->publishBookingAcceptedEvent(BookingAcceptedEvent::create(
            $this->rentalType->getType(),
            $this->rentalPlaceId,
            $this->tenantId,
            $this->days
        ));
    }
}