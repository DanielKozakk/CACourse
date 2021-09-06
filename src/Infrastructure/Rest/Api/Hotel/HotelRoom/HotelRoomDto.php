<?php

namespace Infrastructure\Rest\Api\Hotel\HotelRoom;

class HotelRoomDto
{

    private string $hotelId;
    private int $hotelNumber;
    /**
     * @var array<string, float>
     */
    private array $spacesDefinition;
    private string $description;

    /**
     * @param string $hotelId
     * @param int $hotelNumber
     * @param array<string, float> $spacesDefinition
     * @param string $description
     */
    public function __construct(string $hotelId, int $hotelNumber, array $spacesDefinition, string $description)
    {
        $this->hotelId = $hotelId;
        $this->hotelNumber = $hotelNumber;
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
    public function getHotelNumber(): int
    {
        return $this->hotelNumber;
    }

    /**
     * @return float[]
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