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
    private $aend;

    /**
     * ApartmentBookingDto constructor.
     * @param string $tenantId
     * @param \DateTime $start
     * @param \DateTime $aend
     */
    public function __construct(string $tenantId, \DateTime $start, \DateTime $aend)
    {
        $this->tenantId = $tenantId;
        $this->start = $start;
        $this->aend = $aend;
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
    public function getAend(): \DateTime
    {
        return $this->aend;
    }



}