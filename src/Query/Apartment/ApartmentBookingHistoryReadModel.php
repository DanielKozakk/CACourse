<?php


namespace App\Query\Apartment;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ApartmentBookingHistoryReadModel
 * @package App\Query\Apartment
 * @ORM\Entity
 * TODO: POłącz z apartmentbooking history z domeny
 */
class ApartmentBookingHistoryReadModel
{

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     */
    private string $apartmentBookingHistoryReadModelId;

    /**
     * @ORM\OneToMany(targetEntity=ApartmentBookingReadModel, mappedBy="apartmentBookingHistory")
     */
    private $bookings;

    /**
     * ApartmentBookingHistoryReadModel constructor.
     * @param string $apartmentBookingHistoryReadModelId
     * @param $bookings
     */
    public function __construct(string $apartmentBookingHistoryReadModelId, $bookings)
    {
        $this->apartmentBookingHistoryReadModelId = $apartmentBookingHistoryReadModelId;
        $this->bookings = $bookings;
    }

    /**
     * @return string
     */
    public function getApartmentBookingHistoryReadModelId(): string
    {
        return $this->apartmentBookingHistoryReadModelId;
    }

    /**
     * @return mixed
     */
    public function getBookings()
    {
        return $this->bookings;
    }

}