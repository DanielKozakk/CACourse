<?php


namespace App\Infrastructure\Rest\Api\Apartment;


class ApartmentBookingDto
{

    /**
     * @var string
     */
    private $tenantId;

    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * ApartmentBookingDto constructor.
     * @param string $tenantId
     * @param \DateTime $start
     * @param \DateTime $end
     */
    public function __construct(string $tenantId, \DateTime $start, \DateTime $end)
    {
        $this->tenantId = $tenantId;
        $this->start = $start;
        $this->end = $end;
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
    public function getStart(): \DateTime
    {
        return $this->start;
    }

    /**
     * @return \DateTime
     */
    public function getEnd(): \DateTime
    {
        return $this->end;
    }



}