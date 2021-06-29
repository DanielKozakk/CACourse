<?php


namespace App\Query\Apartment;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class RoomReadModel
 *
 * @ORM\Entity
 *  * TODO: Połącz tą encję z encją Room z domeny, przeczytaj w tym celu dokumentacje Doctrine

 */
class RoomReadModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $squareMeter;

    /**
     * @ORM\ManyToOne(targetEntity=ApartmentReadModel::class, inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $apartment;

    /**
     * Room constructor.
     * @param $id
     * @param string $name
     * @param float $squareMeter
     * @param $apartment
     */
    public function __construct($id, string $name, float $squareMeter, $apartment)
    {
        $this->id = $id;
        $this->name = $name;
        $this->squareMeter = $squareMeter;
        $this->apartment = $apartment;
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
     * @return mixed
     */
    public function getApartment()
    {
        return $this->apartment;
    }


}