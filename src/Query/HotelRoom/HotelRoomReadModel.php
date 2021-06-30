<?php


namespace App\Query\HotelRoom;


use App\Query\Hotel\HotelReadModel;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class HotelRoomReadModel
 * @package App\Query\HotelRoom
 * @ORM\Entity(repositoryClass="DoctrineSqlQueryHotelRoomRepository")
 * TODO: Powiąż z domeną
 */
class HotelRoomReadModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @var SpaceReadModel[]
     * @ORM\OneToMany(targetEntity="SpaceReadModel", mappedBy="hotelRoom")
     */
    private $spacesDefinition;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity=HotelReadModel::class, inversedBy="rooms")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private string $hotelId;

    /**
     * HotelRoomReadModel constructor.
     * @param int $id
     * @param int $number
     * @param SpaceReadModel[] $spacesDefinition
     * @param string $description
     * @param HotelReadModel $hotel
     */
    public function __construct(int $id, int $number, array $spacesDefinition, string $description, string $hotelId)
    {
        $this->id = $id;
        $this->number = $number;
        $this->spacesDefinition = $spacesDefinition;
        $this->description = $description;
        $this->hotelId = $hotelId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return SpaceReadModel[]
     */
    public function getSpacesDefinition(): array
    {
        return $this->spacesDefinition;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getHotel(): string
    {
        return $this->hotelId;
    }



}