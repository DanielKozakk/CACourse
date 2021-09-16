<?php

namespace Query\Apartment;

use Doctrine\ORM\Mapping as ORM;

//TODO: Połącz encje z command
class RoomReadModel
{
    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="string", length=255)
     */
    private string $id;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    /**
     * @var mixed
     * @ORM\Column(type="float")
     */
    private $size;

    /**
     * @var ApartmentReadModel
     * @ORM\ManyToOne(targetEntity="ApartmentReadModel", inversedBy="rooms")
     * @ORM\Column(type="string")
     */
    private $apartmentReadModel;

    /**
     * @param string $name
     * @param mixed $size
     */
    public function __construct(string $name, mixed $size)
    {
        $this->name = $name;
        $this->size = $size;
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
    public function getSize(): mixed
    {
        return $this->size;
    }

    /**
     * @return ApartmentReadModel
     */
    public function getApartmentReadModel(): ApartmentReadModel
    {
        return $this->apartmentReadModel;
    }



}