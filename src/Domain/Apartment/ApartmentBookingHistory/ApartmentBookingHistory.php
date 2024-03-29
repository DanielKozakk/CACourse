<?php

namespace Domain\Apartment\ApartmentBookingHistory;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Domain\Apartment\Apartment;

/**
 * @ORM\Entity(repositoryClass="\Infrastructure\Persistence\Doctrine\Apartment\ApartmentBookingHistory\SqlDoctrineApartmentBookingHistory")
 */
class ApartmentBookingHistory
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\OneToOne(targetEntity="\Domain\Apartment\Apartment")
     */
    private Apartment $apartment;
    /**
     *
     * @var array<ApartmentBooking>|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="ApartmentBooking", mappedBy="apartmentBookingHistory", cascade={"persist", "remove"})
     */
    private array|ArrayCollection|PersistentCollection $apartmentBookingList;

    /**
     * @param Apartment $apartment
     */
    public function __construct(Apartment $apartment)
    {
        $this->apartment = $apartment;
        $this->apartmentBookingList = new ArrayCollection();
    }

    private function add(ApartmentBooking $apartmentBooking)
    {
        $this->apartmentBookingList->add($apartmentBooking);
    }

    public function addBookingStart(DateTime $CreationDateTime, string $ownerId, string $tenantId, BookingPeriod $bookingPeriod, ApartmentBookingHistory $apartmentBookingHistory)
    {
        $this->apartmentBookingList->add(
            ApartmentBooking::start(
                $CreationDateTime,
                $ownerId,
                $tenantId,
                $bookingPeriod,
                $apartmentBookingHistory
            ));
    }
}