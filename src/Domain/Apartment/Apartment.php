<?php


namespace App\Domain\Apartment;


use App\Domain\Event\EventChannel;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * Class Apartment
 * @package App\Domain\Apartment
 *
 * @Entity(repositoryClass="App\Infrastructure\Persistance\Doctrine\Apartment\DoctrineSqlApartmentRepository")
 * TODO: Połącz tą encję z encją Apartment z read modelu, przeczytaj w tym celu dokumentacje Doctrine
 */
class Apartment
{
    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var string
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $ownerId;
    /**
     * @var Address
     *
     * @ORM\Embedded(class="Address")
     */
    private $address;
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="apartment")
     */
    private $rooms;
    /**
     * Apartment constructor.
     * @param string $ownerId
     * @param Address $address
     * @param string $description
     */
    public function __construct(string $ownerId, Address $address, array $rooms, string $description)
    {
        $this->ownerId = $ownerId;
        $this->address = $address;
        $this->description = $description;
        $this->rooms = $rooms;
    }

    public function book(string $tenantId, Period $period, EventChannel $eventChannel) : Booking
    {
        $apartmentBooked =  ApartmentBookedEvent::create($this->id, $this->ownerId, $tenantId, $period);
        $eventChannel->publishApartmentBooked($apartmentBooked);
        return Booking::apartment($this->id, $tenantId, $period);
    }
}