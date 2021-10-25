<?php

namespace Application\Hotel\HotelBookingHistory;

use DataFixtures\HotelFixture;
use DateTime;
use Domain\Hotel\HotelBookingHistory\HotelBookingHistoryRepository;
use Domain\Hotel\HotelRoom\HotelRoomBookedEvent;
use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use Infrastructure\Persistence\Doctrine\Hotel\HotelRoom\DoctrineHotelRoomRepository;
use PHPUnit\Framework\TestCase;

class HotelBookingHistoryEventSubscriberTest extends TestCase
{

    const TENANT_ID = '120312';

    private DateTime $startDate;
    private DateTime $endDate;
    /**
     * @var array<DateTime> $days
     */
    private array $days;

    private HotelBookingHistoryEventSubscriber $hotelBookingHistoryEventSubscriber;

    private HotelBookingHistoryRepository $hotelBookingHistoryRepository;
    private DoctrineHotelRoomRepository $doctrineHotelRoomRepository;
    private DoctrineHotelRepository $doctrineHotelRepository;

    /**
     * @param HotelBookingHistoryEventSubscriber $hotelBookingHistoryEventSubscriber
     */
    public function __construct(HotelBookingHistoryEventSubscriber $hotelBookingHistoryEventSubscriber)
    {

        $this->startDate = new DateTime('2021-01-01');
        $this->endDate = new DateTime('2021-01-02');
        $this->days = [$this->startDate, $this->endDate];

        $this->hotelBookingHistoryEventSubscriber = new HotelBookingHistoryEventSubscriber();
    }

    public function testShould()
    {

    }

    private function getHotelRoomBookedEvent(): HotelRoomBookedEvent
    {
        return HotelRoomBookedEvent::create(HotelFixture::HOTEL_ROOM_ID, HotelFixture::HOTEL_ID, self::TENANT_ID, $this->days);
    }

}
