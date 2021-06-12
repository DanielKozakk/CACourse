<?php


namespace App\Domain\Apartment;


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
    private $rentalType;

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
     * Booking constructor.
     * @param $rentalType
     * @param string $rentalPlaceId
     * @param string $tenantId
     * @param DateTime[] $days
     */
    private function __construct(RentalType $rentalType, string $rentalPlaceId, string $tenantId, array $days)
    {
        $this->rentalType = $rentalType->getState();
        $this->rentalPlaceId = $rentalPlaceId;
        $this->tenantId = $tenantId;
        $this->days = $days;
    }


    public static function apartment(string $rentalPlaceId, string $tenantId, Period $period): Booking
    {
        /** @var DatePeriod[] */
        $days = [$period->asDateTimeArray()];

        return new Booking(RentalType::apartment(), $rentalPlaceId, $tenantId, $days);
    }

    public static function hotelRoom(int $rentalPlaceId, $tenantId, array $days): Booking
    {
         return new Booking(RentalType::hotelRoom(), $rentalPlaceId, $tenantId, $days);
    }
}