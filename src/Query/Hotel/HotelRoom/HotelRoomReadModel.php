<?php

namespace Query\Hotel\HotelRoom;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Domain\Hotel\HotelRoom\Space;

/**
 * @ORM\Entity
 */
class HotelRoomReadModel
{

    /**
     * @ORM\Id
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
    private array|ArrayCollection $spacesReadModel;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $description;

    /**
     * @param int $id
     * @param string $hotelId
     * @param int $hotelRoomNumber
     * @param string $description
     */
    public function __construct(int $id, string $hotelId, int $hotelRoomNumber , string $description)
    {
        $this->id = $id;
        $this->hotelId = $hotelId;
        $this->hotelRoomNumber = $hotelRoomNumber;
        $this->spacesReadModel = new ArrayCollection();
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