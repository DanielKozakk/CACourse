<?php

namespace Query\Apartment;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBooking;


/**
 * @ORM\Entity(repositoryClass="SqlDoctrineQueryApartmentBookingHistoryRepository")
 */
class ApartmentBookingHistoryReadModel
{
    /**
     * @var string
     * @ORM\Id
     *
     */
    private string $apartmentId;

    /**
     *
     * @var array<ApartmentBookingReadModel>|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="ApartmentBooking", mappedBy="apartmentBookingHistory", cascade={"persist", "remove"})
     */
    private array|ArrayCollection|PersistentCollection $apartmentBookingList;

    /**
     * @param string $apartmentId
     * @param ArrayCollection|array $bookings
     */
    public function __construct(string $apartmentId, ArrayCollection|array $bookings)
    {
        $this->apartmentId = $apartmentId;
        $this->bookings = $bookings;
    }


}