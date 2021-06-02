<?php


namespace App\Domain\HotelRoom;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 *  @Entity(repositoryClass="App\Infrastructure\Persistance\Doctrine\HotelRoom\DoctrineSqlHotelRoomRepository")
 */
class HotelRoom
{

    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     *
    /**
     * @var Space[]
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="hotelRoom")
     *
     */
    private $spacesDefinition;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Hotel::class, inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotel;


    /**
     * HotelRoom constructor.
     * @param string $hotelId
     * @param int $number
     * @param Space[] $spacesDefinition
     * @param string $description
     */
    public function __construct(string $hotelId, int $number, array $spacesDefinition, string $description)
    {
        $this->hotelId = $hotelId;
        $this->number = $number;
        $this->spacesDefinition = $spacesDefinition;
        $this->description = $description;
    }


}