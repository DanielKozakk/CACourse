<?php

namespace Application\Hotel\HotelBookingHistory;

use DataFixtures\HotelFixture;
use DateTime;
use Domain\Hotel\HotelBookingHistory\HotelBookingHistory;
use Domain\Hotel\HotelBookingHistory\HotelBookingHistoryRepository;
use Domain\Hotel\HotelBookingHistory\HotelRoomBooking;
use Domain\Hotel\HotelBookingHistory\HotelRoomBookingHistory;
use Domain\Hotel\HotelRoom\HotelRoomBookedEvent;
use Helpers\PropertiesUnwrapper;
use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HotelBookingHistoryEventSubscriberTest extends WebTestCase
{
    use PropertiesUnwrapper;

    const TENANT_ID = '120312';

    private DateTime $startDate;
    private DateTime $endDate;
    /**
     * @var array<DateTime> $days
     */
    private array $days;

    private HotelBookingHistoryEventSubscriber $hotelBookingHistoryEventSubscriber;

    private HotelBookingHistoryRepository $hotelBookingHistoryRepository;
    private DoctrineHotelRepository $doctrineHotelRepository;


    public function __construct()
    {
        parent::__construct();
        self::bootKernel();

        $this->hotelBookingHistoryRepository = $this->createMock(HotelBookingHistoryRepository::class);
        $this->doctrineHotelRepository = $this->createMock(DoctrineHotelRepository::class);

        $this->startDate = new DateTime('2021-01-01');
        $this->endDate = new DateTime('2021-01-02');
        $this->days = [$this->startDate, $this->endDate];

        $this->hotelBookingHistoryEventSubscriber = new HotelBookingHistoryEventSubscriber($this->hotelBookingHistoryRepository, $this->doctrineHotelRepository);
    }

    /**
     */
    public function testShouldUpdateHotelRoomBookingHistory()
    {
        $this->givenExistingHotelBookingHistory();

        $this->hotelBookingHistoryRepository->expects($this->once())->method('save')->with(
            $this->callback(function (HotelBookingHistory $hotelBookingHistory) {
                $hotelRoomBookingHistories = $this->getReflectionValue(HotelBookingHistory::class, 'hotelRoomBookingHistories', $hotelBookingHistory);
                /**
                 * @var HotelRoomBookingHistory
                 */
                $hotelRoomBookingHistory = $hotelRoomBookingHistories[0];
                $hotelRoomBookings = $this->getReflectionValue(HotelRoomBookingHistory::class, 'bookings', $hotelRoomBookingHistory);
                $hotelRoomBooking = $hotelRoomBookings[0];

                $actualTenantId = $this->getReflectionValue(HotelRoomBooking::class, 'tenantId', $hotelRoomBooking);
                $actualDays = $this->getReflectionValue(HotelRoomBooking::class, 'days', $hotelRoomBooking);


                $this->assertEqualsCanonicalizing($this->days, $actualDays);
                $this->assertEquals(self::TENANT_ID, $actualTenantId);
                return true;
            })
        );
        $this->hotelBookingHistoryEventSubscriber->book($this->getHotelRoomBookedEvent());

    }

    private function givenExistingHotelBookingHistory()
    {
        $this->hotelBookingHistoryRepository->method('existsFor')->willReturn(true);

        $hotel = $this->getContainer()->get(DoctrineHotelRepository::class)->findHotelById(HotelFixture::HOTEL_ID);
        $hotelBookingHistory = new HotelBookingHistory($hotel);
        $this->hotelBookingHistoryRepository->method('findFor')->willReturn($hotelBookingHistory);
    }

    private function getHotelRoomBookedEvent(): HotelRoomBookedEvent
    {
        return HotelRoomBookedEvent::create(HotelFixture::HOTEL_ROOM_ID, HotelFixture::HOTEL_ID, self::TENANT_ID, $this->days);
    }

}
