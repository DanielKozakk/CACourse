<?php

namespace Query\Hotel\HotelRoom;

use Doctrine\ORM\Mapping as ORM;
use Domain\Hotel\HotelRoom\Space;

class HotelRoomReadModel
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $hotelId;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $hotelRoomNumber;

    /**
     * @var array<SpaceReadModel> $spaces
     * @ORM\OneToMany(targetEntity="SpaceReadModel", mappedBy="hotelRoomReadModel")
     *
     */
    private array $spacesReadModel;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $description;

    /**
     * @param int $id
     * @param string $hotelId
     * @param int $hotelRoomNumber
     * @param SpaceReadModel[] $spacesReadModel
     * @param string $description
     */
    public function __construct(int $id, string $hotelId, int $hotelRoomNumber, array $spacesReadModel, string $description)
    {
        $this->id = $id;
        $this->hotelId = $hotelId;
        $this->hotelRoomNumber = $hotelRoomNumber;
        $this->spacesReadModel = $spacesReadModel;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHotelId(): string
    {
        return $this->hotelId;
    }

    /**
     * @return int
     */
    public function getHotelRoomNumber(): int
    {
        return $this->hotelRoomNumber;
    }

    /**
     * @return SpaceReadModel[]
     */
    public function getSpacesReadModel(): array
    {
        return $this->spacesReadModel;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }




}