<?php

namespace Query\Hotel\HotelRoom;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 */
class SpaceReadModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @var float
     * @ORM\Column (type="float")
     */
    private float $squareMeter;

    /**
     * @var HotelRoomReadModel
     * @ORM\ManyToOne(targetEntity="HotelRoomReadModel", inversedBy="spacesReadModel")
     */
    private HotelRoomReadModel $hotelRoomReadModel;

    /**
     * @param $id
     * @param string $name
     * @param float $squareMeter
     * @param HotelRoomReadModel $hotelRoomReadModel
     */
    public function __construct(int $id, string $name, float $squareMeter, HotelRoomReadModel $hotelRoomReadModel)
    {
        $this->id = $id;
        $this->name = $name;
        $this->squareMeter = $squareMeter;
        $this->hotelRoomReadModel = $hotelRoomReadModel;
    }

    public static function assignNewSpaceReadModelToHotelRoomReadModel(int $spaceReadModelId, string $name, float $squareMeter, HotelRoomReadModel $hotelRoomReadModel)
    {
        $newSpaceReadModel = new SpaceReadModel($spaceReadModelId, $name, $squareMeter, $hotelRoomReadModel);
        $hotelRoomReadModel->addSpaceToHotelRoom($newSpaceReadModel);
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