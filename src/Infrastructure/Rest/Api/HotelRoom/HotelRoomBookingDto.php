<?php


namespace App\Infrastructure\Rest\Api\HotelRoom;


class HotelRoomBookingDto
{

    /**
     * @var string
     */
    private $tenantId;
    /**
     * @var \DateTime
     */
    private $startDate;
    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * HotelRoomBookingDto constructor.
     * @param string $tenantId
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     */
    public function __construct(string $tenantId, \DateTime $startDate, \DateTime $endDate)
    {
        $this->tenantId = $tenantId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return string
     */
    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }


}