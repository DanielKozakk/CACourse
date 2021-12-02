<?php

namespace Application\Hotel\HotelRoom;

use DateTime;
use Domain\Apartment\Booking;
use Domain\Apartment\BookingRepository;
use Domain\EventChannel\EventChannel;
use Domain\Hotel\HotelRepository;
use Domain\Hotel\HotelRoom\HotelRoom;
use Domain\Hotel\HotelRoom\HotelRoomFactory;
use Domain\Hotel\HotelRoom\HotelRoomRepository;
use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use Infrastructure\Rest\Api\Hotel\HotelRoom\HotelBookingDto;

class HotelRoomApplicationService
{
    private EventChannel $eventChannel;
    private BookingRepository $bookingRepository;
    private HotelRepository $doctrineHotelRepository;
    private HotelRepository $hotelRepository;

    /**
     * @param HotelRepository $hotelRepository
     * @param EventChannel $eventChannel
     * @param BookingRepository $bookingRepository
     * @param HotelRepository $doctrineHotelRepository
     */
    public function __construct(HotelRepository   $hotelRepository,
                                EventChannel      $eventChannel,
                                BookingRepository $bookingRepository,
                                HotelRepository   $doctrineHotelRepository)
    {
        $this->eventChannel = $eventChannel;
        $this->bookingRepository = $bookingRepository;
        $this->doctrineHotelRepository = $doctrineHotelRepository;
        $this->hotelRepository = $hotelRepository;
    }


    /**
     * @param string $hotelId
     * @param int $hotelNumber
     * @param array<string, float> $spacesDefinition
     * @param string $description
     */
    public function addHotelRoom(
        string $hotelId,
        int    $hotelNumber,
        array  $spacesDefinition,
        string $description
    ): void
    {
        $hotelRoom = (new HotelRoomFactory( $this->doctrineHotelRepository))->create(
            $hotelId,
            $hotelNumber,
            $spacesDefinition,
            $description);

        $this->hotelRepository->saveHotelRoom($hotelRoom);
    }

    /**
     * @param int $hotelRoomId
     * @param string $tenantId
     * @param array<DateTime> $days
     */
    public function bookHotelRoom(int $hotelRoomId, string $tenantId, array $days)
    {
        /**
         * @var HotelRoom
         */
        $hotelRoom = $this->hotelRepository->findHotelRoomById($hotelRoomId);

        /**
         * @var Booking
         */
        $booking = $hotelRoom->book($tenantId, $days, $this->eventChannel);

        $this->bookingRepository->save($booking);
    }
}