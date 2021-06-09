<?php


namespace App\Application\HotelRoom;


use App\Domain\Event\EventChannel;
use App\Domain\Hotel\Hotel;
use App\Domain\Hotel\HotelRepository;
use App\Domain\HotelRoom\HotelRoomFactory;
use App\Domain\HotelRoom\HotelRoomRepository;
use App\Domain\HotelRoom\Period;

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
     * HotelRoomApplicationService constructor.
     * @param EventChannel $eventChannel
     * @param HotelRoomRepository $hotelRoomRepository
     * @param HotelRepository|HotelRoomRepository $hotelRepository
     */
    public function __construct(EventChannel $eventChannel, HotelRoomRepository $hotelRoomRepository, HotelRepository|HotelRoomRepository $hotelRepository)
    {
        $this->eventChannel = $eventChannel;
        $this->hotelRoomRepository = $hotelRoomRepository;
        $this->hotelRepository = $hotelRepository;
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
    )
    {
        $hotelRoom =  (new HotelRoomFactory())->create($number, $spacesDefinition, $description, $this->hotelRepository->findById($hotel));

        $this->hotelRoomRepository->save($hotelRoom);

    }

    public function book(int $id, string $tenantId, \DateTime $startDate, \DateTime $endDate)
    {
        $period = new Period ($startDate, $endDate);
        $hotelRoom = $this->hotelRoomRepository->findById($id);
        $hotelRoom->book($tenantId,$period, $this->eventChannel);
    }
}