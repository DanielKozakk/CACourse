<?php

namespace Domain\Apartment\ApartmentBookingHistory;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ ORM\Entity(repositoryClass="\Infrastructure\Persistence\Doctrine\Apartment\ApartmentBookingHistory\SqlDoctrineApartmentBookingHistory")
 * @ORM\Entity()
 *
 */
class ApartmentBooking
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
     * @var BookingPeriod
     * @ORM\Embedded
     */
    private BookingPeriod $bookingPeriod;

    /**
     * @ORM\Embedded
     */
    private BookingStep $bookingStep;

    /**
     * @param DateTime $bookingCreation
     * @param string $ownerId
     * @param string $tenantId
     * @param BookingPeriod $bookingPeriod
     * @param BookingStep $bookingStep
     */
    public function __construct(DateTime $bookingCreation, string $ownerId, string $tenantId, BookingPeriod $bookingPeriod, BookingStep $bookingStep)
    {
        $this->bookingCreation = $bookingCreation;
        $this->ownerId = $ownerId;
        $this->tenantId = $tenantId;
        $this->bookingPeriod = $bookingPeriod;
        $this->bookingStep = $bookingStep;
    }


    public static function start(
        DateTime      $bookingCreation,
        string        $ownerId,
        string        $tenantId,
        BookingPeriod $bookingPeriod
    ): ApartmentBooking
    {

        return new ApartmentBooking($bookingCreation, $ownerId, $tenantId, $bookingPeriod, BookingStep::start());
    }
}