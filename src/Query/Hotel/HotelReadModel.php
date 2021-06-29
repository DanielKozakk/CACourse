<?php


namespace App\Query\Hotel;


use App\Query\HotelRoom\HotelRoomReadModel;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class HotelReadModel
 * @package App\Query\Hotel
 * @ORM\Entity
 * TODO: Powiąż entity z domeną
 */
class HotelReadModel
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     *
     * @var string
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $street;

    /**
     * @ORM\Column(type="string")
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * @var HotelRoomReadModel[]
     * @ORM\OneToMany(targetEntity=HotelRoomReadModel, mappedBy="hotel")
     */
    private $rooms = [];

    /**
     * HotelReadModel constructor.
     * @param string $id
     * @param string $name
     * @param $street
     * @param $postalCode
     * @param $city
     * @param $country
     * @param HotelRoomReadModel[] $rooms
     */
    public function __construct(string $id, string $name, $street, $postalCode, $city, $country, array $rooms)
    {
        $this->id = $id;
        $this->name = $name;
        $this->street = $street;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->country = $country;
        $this->rooms = $rooms;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return HotelRoomReadModel[]
     */
    public function getRooms(): array
    {
        return $this->rooms;
    }


}