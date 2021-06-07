<?php


namespace App\Domain\ApartmentBookingHistory;

use Doctrine\ORM\Mapping as ORM;

class ApartmentBooking
{
    private BookingStep $bookingStep;
    private \DateTime $dateTime;
    private string $getOwnerId;
    private string $getTenantId;
    private BookingPeriod $bookingPeriod;

    /**
     * @ORM\ManyToOne(targetEntity=ApartmentBookingHistory::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $apartmentBookingHistory;

    private function __construct(BookingStep $bookingStep,\DateTime $dateTime, string $getOwnerId, string $getTenantId, BookingPeriod $bookingPeriod){

        $this->bookingStep = $bookingStep;
        $this->getOwnerId = $getOwnerId;
        $this->getTenantId = $getTenantId;
        $this->bookingPeriod = $bookingPeriod;
        $this->dateTime = $dateTime;
    }

    public static function start(\DateTime $bookingCreationDateTime, BookingStep $bookingStep, string $ownerId, string $tenantId, BookingPeriod $bookingPeriod) : ApartmentBooking
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