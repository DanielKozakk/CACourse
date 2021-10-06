<?php

namespace Application\Hotel\HotelRoom;

use DateTime;
use Domain\Apartment\Booking;
use Domain\Apartment\BookingRepository;
use Domain\EventChannel\EventChannel;
use Domain\Hotel\HotelRoom\HotelRoom;
use Domain\Hotel\HotelRoom\HotelRoomFactory;
use Domain\Hotel\HotelRoom\HotelRoomRepository;
use Infrastructure\Rest\Api\Hotel\HotelRoom\HotelBookingDto;

class HotelRoomApplicationService
{
    private HotelRoomRepository $hotelRoomRepository;
    private EventChannel $eventChannel;
    private BookingRepository $bookingRepository;

    /**
     * @param HotelRoomRepository $hotelRoomRepository
     * @param EventChannel $eventChannel
     * @param BookingRepository $bookingRepository
     */
    public function __construct(HotelRoomRepository $hotelRoomRepository, EventChannel $eventChannel, BookingRepository $bookingRepository)
    {
        $this->hotelRoomRepository = $hotelRoomRepository;
        $this->eventChannel = $eventChannel;
        $this->bookingRepository = $bookingRepository;
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

        /**
         * @var Booking
         */
        $booking = $hotelRoom->book($tenantId, $days, $this->eventChannel);

        $this->bookingRepository->save($booking);
    }



}