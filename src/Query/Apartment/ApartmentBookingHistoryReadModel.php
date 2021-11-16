<?php

namespace Query\Apartment;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBooking;


/**
 * @ORM\Entity(repositoryClass="SqlDoctrineQueryApartmentBookingHistoryRepository")
 * @ORM\Table(name="apartment_booking_history_read_model")
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
     * @ORM\OneToOne(targetEntity="ApartmentReadModel")
     */
    private ApartmentReadModel $apartment;

    /**
     *
     * @var array<ApartmentBookingReadModel>|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="ApartmentBookingReadModel", mappedBy="apartmentBookingHistoryReadModel", cascade={"persist", "remove"})
     */
    private array|ArrayCollection|PersistentCollection $apartmentBookingReadModelList;

    /**
     * @param ApartmentReadModel $apartment
     */
    public function __construct(int $id, ApartmentReadModel $apartment)
    {
        $this->id = $id;
        $this->apartment = $apartment;
        $this->apartmentBookingReadModelList = new ArrayCollection();
    }

    /**
     * @param array<ApartmentBookingReadModel> $apartmentBookingReadModelList
     */
    public function setApartmentBookingReadModelList(array $apartmentBookingReadModelList){
        $this->apartmentBookingReadModelList = $apartmentBookingReadModelList;
    }

    public function getApartmentBookingReadModelList (): ArrayCollection|PersistentCollection|array
    {
        return $this->apartmentBookingReadModelList;
    }
}