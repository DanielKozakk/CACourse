<?php

namespace Query\Apartment;

// ta sama tabela co apartmentBooking
use DateTime;
use Doctrine\ORM\Mapping as ORM;

class ApartmentBookingReadModel
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
    private DateTime $bookingCreationDateTime;
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
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private DateTime $startDate;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private DateTime $endDate;


}