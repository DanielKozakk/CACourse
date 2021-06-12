<?php


namespace App\Application\Booking;

use App\Domain\Apartment\RentalType;
use DateTime;

class BookingAcceptCommand
{
    private string $bookingId;

    private DateTime $creationDate;

    private string $rentalType;

    private int $objectId;

    private string $tenantId;

    /**
     * @var DateTime[]
     */
    private array $days;

    /**
     * BookingAcceptCommand constructor.
     * @param string $bookingId
     * @param DateTime $creationDate
     * @param string $rentalType
     * @param int $objectId
     * @param string $tenantId
     * @param DateTime[] $days
     */
    public function __construct(string $bookingId, DateTime $creationDate, string $rentalType, int $objectId, string $tenantId, array $days)
    {
        $this->bookingId = $bookingId;
        $this->creationDate = $creationDate;
        $this->rentalType = $rentalType;
        $this->objectId = $objectId;
        $this->tenantId = $tenantId;
        $this->days = $days;
    }

    /**
     * @return string
     */
    public function getBookingId(): string
    {
        return $this->bookingId;
    }

    /**
     * @return DateTime
     */
    public function getCreationDate(): DateTime
    {
        return $this->creationDate;
    }

    /**
     * @return string
     */
    public function getRentalType(): string
    {
        return $this->rentalType;
    }

    /**
     * @return int
     */
    public function getObjectId(): int
    {
        return $this->objectId;
    }

    /**
     * @return string
     */
    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    /**
     * @return DateTime[]
     */
    public function getDays(): array
    {
        return $this->days;
    }




}