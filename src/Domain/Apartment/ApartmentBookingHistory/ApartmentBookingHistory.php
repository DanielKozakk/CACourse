<?php

namespace Domain\Apartment\ApartmentBookingHistory;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     *
     */
    private string $apartment;
    /**
     *
     * @var array<ApartmentBooking>|ArrayCollection
     * @ORM\OneToMany(targetEntity="ApartmentBooking", mappedBy="apartmentBookingHistory")
     */
    private array|ArrayCollection $apartmentBookingList;

    /**
     * @param string $apartment
     */
    public function __construct(string $apartment)
    {
        $this->apartment = $apartment;

    }


    public function add(ApartmentBooking $apartmentBooking){
        array_push($this->apartmentBookingList, $apartmentBooking);
    }

}