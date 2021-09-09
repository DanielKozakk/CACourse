<?php

namespace Application\Hotel\HotelRoom;

use DateTime;
use Domain\EventChannel\EventChannel;
use Domain\Hotel\HotelRoom\HotelRoom;
use Domain\Hotel\HotelRoom\HotelRoomFactory;
use Domain\Hotel\HotelRoom\HotelRoomRepository;
use Infrastructure\Rest\Api\Hotel\HotelRoom\HotelBookingDto;

class HotelRoomApplicationService
{
    private HotelRoomRepository $hotelRoomRepository;
    private EventChannel $eventChannel;

    /**
     * @param HotelRoomRepository $hotelRoomRepository
     * @param EventChannel $eventChannel
     */
    public function __construct(HotelRoomRepository $hotelRoomRepository, EventChannel $eventChannel)
    {
        $this->hotelRoomRepository = $hotelRoomRepository;
        $this->eventChannel = $eventChannel;
    }


    /**
     * @param string $hotelId
     * @param int $hotelNumber
     * @param array<string, float> $spacesDefinition
     * @param string $description
     */
    public function addRoomToHotel(
        string $hotelId,
        int    $hotelNumber,
        array  $spacesDefinition,
        string $description
    ): void
    {
        $hotelRoom = (new HotelRoomFactory)->create($hotelId, $hotelNumber, $spacesDefinition, $description);

        $this->hotelRoomRepository->save($hotelRoom);
    }

    /**
     * @param string $hotelRoomId
     * @param string $tenantId
     * @param array<DateTime> $days
     */
    public function bookHotelRoom(string $hotelRoomId, string $tenantId, array $days)
    {
        /**
         * @var HotelRoom
         */
        $hotelRoom = $this->hotelRoomRepository->findById($hotelRoomId);
        $hotelRoom->book($tenantId, $days, $this->eventChannel);

    }

}