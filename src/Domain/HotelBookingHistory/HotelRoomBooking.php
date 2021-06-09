<?php

namespace App\Domain\HotelBookingHistory;


use DateTime;
use DateTimeInterface;
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
    private ?DateTimeInterface $hotelBookingCreationDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $tenantId;

    /**
     * @ORM\Embedded(class = "HotelRoomBookingPeriod")
     */
    private HotelRoomBookingPeriod $hotelBookingPeriod;

    /**
     * @ORM\ManyToOne(targetEntity=HotelRoomBookingHistory::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private HotelBookingHistory $hotelBookingHistory;

    /**
     * @ORM\Embedded(class="HotelBookingStep")
     */
    private mixed $hotelBookingStep;

    /**
     * HotelBooking constructor.
     * @param DateTime $hotelBookingCreationDate
     * @param string $tenantId
     * @param HotelRoomBookingPeriod $hotelBookingPeriod
     * @param $hotelBookingStep
     */
    public function __construct(DateTime $hotelBookingCreationDate, string $tenantId, DateTime $startDate, DateTime $endDate)
    {
        $this->hotelBookingCreationDate = $hotelBookingCreationDate;
        $this->tenantId = $tenantId;
        $this->hotelBookingStep = new HotelRoomBookingPeriod($startDate, $endDate);

    }

//
//    /**
//     * @param DateTime $bookingCreationDateTime
//     * @param string $tenantId
//     * @param HotelRoomBookingPeriod $bookingPeriod
//     * @return HotelBooking
//     */
//    public static function start(string $tenantId, HotelRoomBookingPeriod $bookingPeriod) : HotelBooking
//    {
//        return new HotelBooking(new \DateTime(), $tenantId, $bookingPeriod, new HotelBookingStep(HotelBookingStep::START));
//    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getHotelBookingCreationDate(): ?DateTimeInterface
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
     * @return HotelRoomBookingPeriod
     */
    public function getHotelBookingPeriod(): HotelRoomBookingPeriod
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
     * @param HotelBookingHistory $hotelBookingHistory
     */
    public function setHotelBookingHistory(HotelBookingHistory $hotelBookingHistory): void
    {
        $this->hotelBookingHistory = $hotelBookingHistory;
    }



}
