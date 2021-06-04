<?php


namespace App\Application\HotelRoom;

use App\Domain\Apartment\EventChannel;
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
     * HotelRoomApplicationService constructor.
     * @param EventChannel $eventChannel
     * @param HotelRoomRepository $hotelRoomRepository
     */
    public function __construct(EventChannel $eventChannel, HotelRoomRepository $hotelRoomRepository)
    {
        $this->eventChannel = $eventChannel;
        $this->hotelRoomRepository = $hotelRoomRepository;
    }


    /**
     * @param int $number
     * @param array $spacesDefinition
     * @param string $description
     */
    public function add(
        int $number,
        array $spacesDefinition,
        string $description
    )
    {
        $hotelRoom =  (new HotelRoomFactory())->create($number, $spacesDefinition, $description);

        $this->hotelRoomRepository->save($hotelRoom);

    }

    public function book(int $id, string $tenantId, \DateTime $startDate, \DateTime $endDate)
    {
        $period = new Period ($startDate, $endDate);
        $hotelRoom = $this->hotelRoomRepository->findById($id);
        $hotelRoom->book($tenantId,$period, $this->eventChannel);
    }
}