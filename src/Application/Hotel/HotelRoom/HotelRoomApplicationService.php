<?php

namespace Application\Hotel\HotelRoom;

use DateTime;
use Domain\Apartment\Booking;
use Domain\Apartment\BookingRepository;
use Domain\EventChannel\EventChannel;
use Domain\Hotel\HotelRepository;
use Domain\Hotel\HotelRoom\HotelRoom;

class HotelRoomApplicationService
{
    private EventChannel $eventChannel;
    private BookingRepository $bookingRepository;
    private HotelRepository $hotelRepository;

    /**
     * @param HotelRepository $hotelRepository
     * @param EventChannel $eventChannel
     * @param BookingRepository $bookingRepository
     */
    public function __construct(HotelRepository   $hotelRepository,
                                EventChannel      $eventChannel,
                                BookingRepository $bookingRepository,
    )
    {
        $this->eventChannel = $eventChannel;
        $this->bookingRepository = $bookingRepository;
        $this->hotelRepository = $hotelRepository;
    }


    /**
     * @param string $hotelId
     * @param int $hotelRoomNumber
     * @param array<string, float> $spacesDefinition
     * @param string $description
     */
    public function addHotelRoom(
        string $hotelId,
        int    $hotelRoomNumber,
        array  $spacesDefinition,
        string $description
    ): int
    {
        $hotel = $this->hotelRepository->findHotelById($hotelId);
        $hotelClass = get_class($hotel);
        file_put_contents("Debug.log", __CLASS__ . "::". __LINE__ . "hotel class - $hotelClass \n", 8);
        $this->hotelRepository->saveHotel($hotel);
        $hotel->addRoom($hotelRoomNumber, $spacesDefinition, $description, $this->hotelRepository);
        $this->hotelRepository->saveHotel($hotel);

//        $hotelRooms = $hotel->getHotelRooms()->toArray();
//        $hotelRoomsCount = count($hotelRooms);
//        file_put_contents("Debug.log", __CLASS__ . "::". __LINE__ . " hotel rooms - $hotelRoomsCount \n", 8);
//
//        $hotel = $this->hotelRepository->findHotelById($hotelId);
//        $hotelClass = get_class($hotel);
//        file_put_contents("Debug.log", __CLASS__ . "::". __LINE__ . " is Hotel Fetched? :$hotelClass \n", 8);
//
//        $hotelRoomsEmpty = $hotel->getHotelRooms()->isEmpty() ? "empty" : "not-empty";
//
//        file_put_contents("Debug.log", __CLASS__ . "::". __LINE__ . " hotel rooms2 empty? : - $hotelRoomsEmpty \n", 8);




        $hotelRoomId = $hotel->getIdOfRoom($hotelRoomNumber);



        return $hotelRoomId;
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