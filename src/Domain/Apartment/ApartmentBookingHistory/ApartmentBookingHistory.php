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
     * @ORM\Column(type="string", length=255)
     */
    private string $apartmentId;

    /**
     *
     * @var array<ApartmentBooking>|ArrayCollection
     */
    private $apartmentBookingList;

    /**
     * @param string $apartmentId
     */
    public function __construct(string $apartmentId)
    {
        $this->apartmentId = $apartmentId;
        $this->apartmentBookingList = new ArrayCollection();
    }


    public function add(ApartmentBooking $apartmentBooking){

        array_push($this->apartmentBookingList, $apartmentBooking);

    }

}