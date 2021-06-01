<?php


namespace App\Domain\HotelRoom;


class HotelRoom
{
    /**
     * @var string
     */
    private $hotelId;

    /**
     * @var int
     */
    private $number;

    /**
     * @var Space[]
     */
    private $spacesDefinition;

    /**
     * @var string
     */
    private $description;

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