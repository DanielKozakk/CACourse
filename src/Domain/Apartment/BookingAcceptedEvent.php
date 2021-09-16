<?php

namespace Domain\Apartment;

class BookingAcceptedEvent
{
    private string $rentalType;
    private string $rentalPlaceId;
    private string $tenantId;
    private array $days;

    /**
     * @param string $rentalType
     * @param string $rentalPlaceId
     * @param string $tenantId
     * @param array $days
     */
    private function __construct(string $rentalType, string $rentalPlaceId, string $tenantId, array $days)
    {
        $this->rentalType = $rentalType;
        $this->rentalPlaceId = $rentalPlaceId;
        $this->tenantId = $tenantId;
        $this->days = $days;
    }


    public static function create(RentalType $rentalType, string $rentalPlaceId, string $tenantId, array $days): BookingAcceptedEvent
    {
        return new BookingAcceptedEvent($rentalType->getState(), $rentalPlaceId, $tenantId, $days);
    }

    /**
     * @return string
     */
    public function getRentalType(): string
    {
        return $this->rentalType;
    }

    /**
     * @return string
     */
    public function getRentalPlaceId(): string
    {
        return $this->rentalPlaceId;
    }

    /**
     * @return string
     */
    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    /**
     * @return array
     */
    public function getDays(): array
    {
        return $this->days;
    }


}