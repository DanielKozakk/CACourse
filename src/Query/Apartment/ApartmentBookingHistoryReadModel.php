<?php

namespace Query\Apartment;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBooking;


/**
 * @ORM\Entity(repositoryClass="SqlDoctrineQueryApartmentBookingHistoryRepository")
 */
class ApartmentBookingHistoryReadModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private int $id;
    /**
     * @var ApartmentReadModel
     */
    private ApartmentReadModel $apartment;

    /**
     *
     * @var array<ApartmentBookingReadModel>|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="ApartmentBooking", mappedBy="apartmentBookingHistory", cascade={"persist", "remove"})
     */
    private array|ArrayCollection|PersistentCollection $apartmentBookingReadModelList;

    /**
     * @param ApartmentReadModel $apartment
     * @param ArrayCollection|array $apartmentBookingReadModelList
     */
    public function __construct(int $id, ApartmentReadModel $apartment, ArrayCollection|array $apartmentBookingReadModelList)
    {
        $this->id = $id;
        $this->apartment = $apartment;
        $this->apartmentBookingReadModelList = $apartmentBookingReadModelList;
    }

    /**
     * @param array<ApartmentBookingReadModel> $apartmentBookingReadModelList
     */
    public function setApartmentBookingReadModelList(array $apartmentBookingReadModelList){
        $this->apartmentBookingReadModelList = $apartmentBookingReadModelList;
    }


}