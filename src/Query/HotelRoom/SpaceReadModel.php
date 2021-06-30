<?php


namespace App\Query\HotelRoom;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class SpaceReadModel
 * @package App\Query\HotelRoom
 * @ORM\Entity
 * TODO: powiąż z domeną
 */
class SpaceReadModel
{

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var float
     * @ORM\Column(type="float")
     *
     */
    private float $squareMeter;

    /**
     * @var HotelRoomReadModel
     * @ORM\ManyToOne(targetEntity="HotelRoomReadModel")
     */
    private $hotelRoomReadModel;

    /**
     * SpaceReadModel constructor.
     * @param string $id
     * @param string $name
     * @param float $squareMeter
     * @param HotelRoomReadModel $hotelRoomReadModel
     */
    public function __construct(string $id, string $name, float $squareMeter, HotelRoomReadModel $hotelRoomReadModel)
    {
        $this->id = $id;
        $this->name = $name;
        $this->squareMeter = $squareMeter;
        $this->hotelRoomReadModel = $hotelRoomReadModel;
    }

    /**
     * @return mixed
     */
    public function getId()
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
     * @return float
     */
    public function getSquareMeter(): float
    {
        return $this->squareMeter;
    }

    /**
     * @return HotelRoomReadModel
     */
    public function getHotelRoomReadModel(): HotelRoomReadModel
    {
        return $this->hotelRoomReadModel;
    }
}