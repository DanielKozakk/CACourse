<?php


namespace App\Query\Apartment;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ApartmentBookingReadModel
 * @package App\Query\Apartment
 *
 * TODO:Połącz z domenowym
 */
class ApartmentBookingReadModel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private String $bookingStep;
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
     * @ORM\Column(type="datetime", length=255)
     */
    private DateTime $startDate;
    /**
     * @ORM\Column(type="datetime", length=255)
     */
    private DateTime $endDate;


    /**
     * @ORM\ManyToOne(targetEntity=ApartmentBookingHistoryReadModel, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?ApartmentBookingHistoryReadModel $apartmentBookingHistory;

    /**
     * ApartmentBookingReadModel constructor.
     * @param $id
     * @param String $bookingStep
     * @param DateTime $dateTime
     * @param string $getOwnerId
     * @param string $getTenantId
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param ApartmentBookingHistoryReadModel|null $apartmentBookingHistory
     */
    public function __construct($id, string $bookingStep, DateTime $dateTime, string $getOwnerId, string $getTenantId, DateTime $startDate, DateTime $endDate, ?ApartmentBookingHistoryReadModel $apartmentBookingHistory)
    {
        $this->id = $id;
        $this->bookingStep = $bookingStep;
        $this->dateTime = $dateTime;
        $this->getOwnerId = $getOwnerId;
        $this->getTenantId = $getTenantId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->apartmentBookingHistory = $apartmentBookingHistory;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getBookingStep(): string
    {
        return $this->bookingStep;
    }

    /**
     * @return DateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    /**
     * @return string
     */
    public function getGetOwnerId(): string
    {
        return $this->getOwnerId;
    }

    /**
     * @return string
     */
    public function getGetTenantId(): string
    {
        return $this->getTenantId;
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
     * @return ApartmentBookingHistoryReadModel|null
     */
    public function getApartmentBookingHistory(): ?ApartmentBookingHistoryReadModel
    {
        return $this->apartmentBookingHistory;
    }
}