<?php

namespace Query\Apartment;

//TODO ta sama tabela co apartmentBooking
use DateTime;
use Doctrine\ORM\Mapping as ORM;

class ApartmentBookingReadModel
{

    /**
     * @var $id
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private DateTime $bookingCreation;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $ownerId;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $tenantId;
    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private DateTime $startDate;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private DateTime $endDate;

    /**
     *  @ORM\Column(type="string")
     */
    private string $bookingStep;

    /**
     * @param DateTime $bookingCreation
     * @param string $ownerId
     * @param string $tenantId
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param string $bookingStep
     */
    public function __construct(DateTime $bookingCreation, string $ownerId, string $tenantId, DateTime $startDate, DateTime $endDate, string $bookingStep)
    {
        $this->bookingCreation = $bookingCreation;
        $this->ownerId = $ownerId;
        $this->tenantId = $tenantId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->bookingStep = $bookingStep;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getBookingCreation(): DateTime
    {
        return $this->bookingCreation;
    }

    /**
     * @return string
     */
    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    /**
     * @return string
     */
    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @return string
     */
    public function getBookingStep(): string
    {
        return $this->bookingStep;
    }



}