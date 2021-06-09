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
    private $hotelRoomBookingStep;

    /**
     * HotelRoomBooking constructor.
     * @param $hotelRoomBookingCreationDate
     * @param $tenantId
     * @param HotelBookingPeriod $hotelRoomBookingPeriod
     * @param $hotelRoomBookingHistory
     * @param $hotelRoomBookingStep
     */
    private function __construct($hotelRoomBookingCreationDate, $tenantId, HotelBookingPeriod $hotelRoomBookingPeriod, HotelBookingStep $hotelRoomBookingStep)
    {
        $this->hotelBookingCreationDate = $hotelRoomBookingCreationDate;
        $this->tenantId = $tenantId;
        $this->hotelBookingPeriod = $hotelRoomBookingPeriod;
        $this->hotelRoomBookingStep = $hotelRoomBookingStep;
    }


    public static function start(DateTime $bookingCreationDateTime, string $tenantId, HotelBookingPeriod $bookingPeriod) : HotelBooking
    {
        return new HotelBooking($bookingCreationDateTime, $tenantId, $bookingPeriod, new HotelBookingStep(HotelBookingStep::START));
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHotelBookingCreationDate(): ?\DateTimeInterface
    {
        return $this->hotelBookingCreationDate;
    }

    public function setHotelBookingCreationDate(\DateTimeInterface $hotelBookingCreationDate): self
    {
        $this->hotelBookingCreationDate = $hotelBookingCreationDate;

        return $this;
    }

    public function getTenantId(): ?string
    {
        return $this->tenantId;
    }

    public function setTenantId(string $tenantId): self
    {
        $this->tenantId = $tenantId;

        return $this;
    }

    public function getHotelBookingHistory(): ?HotelBookingHistory
    {
        return $this->hotelBookingHistory;
    }

    public function setHotelBookingHistory(?HotelBookingHistory $hotelBookingHistory): self
    {
        $this->hotelBookingHistory = $hotelBookingHistory;

        return $this;
    }
}
