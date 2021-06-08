<?php


namespace App\Domain\ApartmentBookingHistory;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 */
class ApartmentBooking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Embedded
     */
    private BookingStep $bookingStep;
    /**
     * @ORM\Column(type="datetime", length=255)
     */
    private DateTime $dateTime;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $getOwnerId;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $getTenantId;

    /**
     * @ORM\Embedded
     */
    private BookingPeriod $bookingPeriod;

    /**
     * @ORM\ManyToOne(targetEntity=ApartmentBookingHistory::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $apartmentBookingHistory;

    private function __construct(BookingStep $bookingStep, DateTime $dateTime, string $getOwnerId, string $getTenantId, BookingPeriod $bookingPeriod){

        $this->bookingStep = $bookingStep;
        $this->getOwnerId = $getOwnerId;
        $this->getTenantId = $getTenantId;
        $this->bookingPeriod = $bookingPeriod;
        $this->dateTime = $dateTime;
    }

    public static function start(DateTime $bookingCreationDateTime, BookingStep $bookingStep, string $ownerId, string $tenantId, BookingPeriod $bookingPeriod) : ApartmentBooking
    {
        return new ApartmentBooking($bookingStep, $bookingCreationDateTime, $ownerId, $tenantId, $bookingPeriod);
    }

    public function getApartmentBookingHistory(): ?ApartmentBookingHistory
    {
        return $this->apartmentBookingHistory;
    }

    public function setApartmentBookingHistory(?ApartmentBookingHistory $apartmentBookingHistory): self
    {
        $this->apartmentBookingHistory = $apartmentBookingHistory;

        return $this;
    }


}