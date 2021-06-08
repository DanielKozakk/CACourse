<?php

namespace App\Domain\HotelRoomBookingHistory;


use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class HotelRoomBooking
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
    private $hotelRoomBookingCreationDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tenantId;


    /**
     * @ORM\Embedded(class = "HotelRoomBookingPeriod")
     */
    private HotelRoomBookingPeriod $hotelRoomBookingPeriod;

    /**
     * @ORM\ManyToOne(targetEntity=HotelRoomBookingHistory::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?HotelRoomBookingHistory $hotelRoomBookingHistory;

    /**
     * @ORM\Embedded(class="HotelRoomBookingStep")
     */
    private $hotelRoomBookingStep;

    /**
     * HotelRoomBooking constructor.
     * @param $hotelRoomBookingCreationDate
     * @param $tenantId
     * @param HotelRoomBookingPeriod $hotelRoomBookingPeriod
     * @param $hotelRoomBookingHistory
     * @param $hotelRoomBookingStep
     */
    private function __construct($hotelRoomBookingCreationDate, $tenantId, HotelRoomBookingPeriod $hotelRoomBookingPeriod, HotelRoomBookingStep $hotelRoomBookingStep)
    {
        $this->hotelRoomBookingCreationDate = $hotelRoomBookingCreationDate;
        $this->tenantId = $tenantId;
        $this->hotelRoomBookingPeriod = $hotelRoomBookingPeriod;
        $this->hotelRoomBookingStep = $hotelRoomBookingStep;
    }


    public static function start(DateTime $bookingCreationDateTime, string $tenantId, HotelRoomBookingPeriod $bookingPeriod) : HotelRoomBooking
    {
        return new HotelRoomBooking($bookingCreationDateTime, $tenantId, $bookingPeriod, new HotelRoomBookingStep(HotelRoomBookingStep::START));
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHotelRoomBookingCreationDate(): ?\DateTimeInterface
    {
        return $this->hotelRoomBookingCreationDate;
    }

    public function setHotelRoomBookingCreationDate(\DateTimeInterface $hotelRoomBookingCreationDate): self
    {
        $this->hotelRoomBookingCreationDate = $hotelRoomBookingCreationDate;

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

    public function getHotelRoomBookingHistory(): ?HotelRoomBookingHistory
    {
        return $this->hotelRoomBookingHistory;
    }

    public function setHotelRoomBookingHistory(?HotelRoomBookingHistory $hotelRoomBookingHistory): self
    {
        $this->hotelRoomBookingHistory = $hotelRoomBookingHistory;

        return $this;
    }
}
