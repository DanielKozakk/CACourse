<?php

namespace App\Domain\HotelBookingHistory;


use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class HotelBooking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private ?\DateTimeInterface $hotelBookingCreationDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $tenantId;

    /**
     * @ORM\Embedded(class = "HotelBookingPeriod")
     */
    private HotelBookingPeriod $hotelBookingPeriod;

    /**
     * @ORM\ManyToOne(targetEntity=HotelBookingHistory::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?HotelBookingHistory $hotelBookingHistory;

    /**
     * @ORM\Embedded(class="HotelBookingStep")
     */
    private $hotelBookingStep;

    /**
     * HotelBooking constructor.
     * @param \DateTimeInterface|null $hotelBookingCreationDate
     * @param string|null $tenantId
     * @param HotelBookingPeriod $hotelBookingPeriod
     * @param HotelBookingHistory|null $hotelBookingHistory
     * @param $hotelBookingStep
     */
    public function __construct(?\DateTimeInterface $hotelBookingCreationDate, ?string $tenantId, HotelBookingPeriod $hotelBookingPeriod, $hotelBookingStep)
    {
        $this->hotelBookingCreationDate = $hotelBookingCreationDate;
        $this->tenantId = $tenantId;
        $this->hotelBookingPeriod = $hotelBookingPeriod;

        $this->hotelBookingStep = $hotelBookingStep;
    }


    /**
     * @param DateTime $bookingCreationDateTime
     * @param string $tenantId
     * @param HotelBookingPeriod $bookingPeriod
     * @return HotelBooking
     */
    public static function start(DateTime $bookingCreationDateTime, string $tenantId, HotelBookingPeriod $bookingPeriod) : HotelBooking
    {
        return new HotelBooking($bookingCreationDateTime, $tenantId, $bookingPeriod, new HotelBookingStep(HotelBookingStep::START));
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getHotelBookingCreationDate(): ?\DateTimeInterface
    {
        return $this->hotelBookingCreationDate;
    }

    /**
     * @return string|null
     */
    public function getTenantId(): ?string
    {
        return $this->tenantId;
    }

    /**
     * @return HotelBookingPeriod
     */
    public function getHotelBookingPeriod(): HotelBookingPeriod
    {
        return $this->hotelBookingPeriod;
    }

    /**
     * @return HotelBookingHistory|null
     */
    public function getHotelBookingHistory(): ?HotelBookingHistory
    {
        return $this->hotelBookingHistory;
    }

    /**
     * @return mixed
     */
    public function getHotelBookingStep()
    {
        return $this->hotelBookingStep;
    }

    /**
     * @param HotelBookingHistory|null $hotelBookingHistory
     */
    public function setHotelBookingHistory(?HotelBookingHistory $hotelBookingHistory): void
    {
        $this->hotelBookingHistory = $hotelBookingHistory;
    }



}
