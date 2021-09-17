<?php

namespace Query\Apartment;

// Tabela ta sama co w apartmentBookingHistory
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 */
class ApartmentBookingHistoryReadModel
{
    /**
     * @var string
     * @ORM\Id
     */
    private string $apartmentId;

    /**
     * @var ArrayCollection|array<ApartmentBookingReadModel>
     *
     * @ORM\OneToMany(targetEntity="ApartmentBookingReadModel")
     */
    private ArrayCollection|array $bookings;

    /**
     * @param string $apartmentId
     * @param ArrayCollection|ApartmentBookingReadModel[] $bookings
     */
    public function __construct(string $apartmentId, ArrayCollection|array $bookings)
    {
        $this->apartmentId = $apartmentId;
        $this->bookings = $bookings;
    }


}