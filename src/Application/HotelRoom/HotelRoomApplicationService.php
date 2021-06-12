<?php


namespace App\Application\HotelRoom;


use App\Domain\Apartment\Booking;
use App\Domain\Apartment\BookingRepository;
use App\Domain\Apartment\Period;
use App\Domain\Event\EventChannel;
use App\Domain\Hotel\HotelRepository;
use App\Domain\HotelRoom\HotelRoomFactory;
use App\Domain\HotelRoom\HotelRoomRepository;

class HotelRoomApplicationService
{

    private EventChannel $eventChannel;
    /**
     * @var HotelRoomRepository
     */
    private HotelRoomRepository $hotelRoomRepository;

    /**
     * @var HotelRepository
     */
    private HotelRepository $hotelRepository;

    /**
     * @var BookingRepository
     */
    private $bookingRepository;

    /**
     * HotelRoomApplicationService constructor.
     * @param EventChannel $eventChannel
     * @param HotelRoomRepository $hotelRoomRepository
     * @param HotelRepository $hotelRepository
     * @param BookingRepository $bookingRepository
     */
    public function __construct(EventChannel $eventChannel, HotelRoomRepository $hotelRoomRepository, HotelRepository $hotelRepository, BookingRepository $bookingRepository)
    {
        $this->eventChannel = $eventChannel;
        $this->hotelRoomRepository = $hotelRoomRepository;
        $this->hotelRepository = $hotelRepository;
        $this->bookingRepository = $bookingRepository;
    }


    /**
     * @param int $number
     * @param array $spacesDefinition
     * @param string $description
     */
    public function add(
        int $number,
        array $spacesDefinition,
        string $description,
        string $hotel
    ){
        $hotelRoom =  (new HotelRoomFactory())->create($number, $spacesDefinition, $description, $this->hotelRepository->findById($hotel));
        $this->hotelRoomRepository->save($hotelRoom);
    }

    public function book(int $id, string $tenantId, \DateTime $startDate, \DateTime $endDate){
        $days = (new Period ($startDate, $endDate))->asDateTimeArray();
        $hotelRoom = $this->hotelRoomRepository->findById($id);

        /** @var Booking $booking */
        $booking = $hotelRoom->book($tenantId,$days, $this->eventChannel);

        $this->bookingRepository->save($booking);
    }
}