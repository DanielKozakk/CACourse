<?php


namespace App\Infrastructure\Rest\Api\HotelRoom;


class HotelRoomDto
{

    /**
     * @var string
     */
    private string $hotelId;
    /**
     * @var int
     */
    private int $number;
    /**
     * @var array
     */
    private array $spacesDefinition;
    /**
     * @var string
     */
    private string $description;

    /**
     * HotelRoomDto constructor.
     * @param string $hotelId
     * @param int $number
     * @param array $spacesDefinition
     * @param string $description
     */
    public function __construct(string $hotelId, int $number, array $spacesDefinition, string $description)
    {
        $this->hotelId = $hotelId;
        $this->number = $number;
        $this->spacesDefinition = $spacesDefinition;
        $this->description = $description;
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
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return array
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

}