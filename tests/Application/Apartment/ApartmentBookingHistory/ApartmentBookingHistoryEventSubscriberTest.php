<?php

namespace Application\Apartment\ApartmentBookingHistory;

use DataFixtures\ApartmentFixture;
use DateTime;
use Domain\Apartment\ApartmentBookedEvent;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBooking;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingAssertion;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistoryRepository;
use Domain\Apartment\ApartmentBookingHistory\BookingPeriod;
use Domain\Apartment\ApartmentRepository;
use Helpers\PropertiesUnwrapper;
use Infrastructure\Persistence\Doctrine\Apartment\ApartmentBookingHistory\DoctrineApartmentBookingHistory;
use Infrastructure\Persistence\Doctrine\Apartment\DoctrineApartmentRepository;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApartmentBookingHistoryEventSubscriberTest extends WebTestCase
{
    use PropertiesUnwrapper;

    private ApartmentBookingHistoryEventSubscriber $eventListener;

    private ApartmentBookingHistoryRepository $apartmentBookingHistoryRepository;
    private ApartmentRepository $apartmentRepository;

    private const apartmentId = ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId'];
    private const ownerId = ApartmentFixture::FIRST_TEST_APARTMENT['ownerId'];
    private const tenantId = '12345678910';

    private DateTime $startDate;
    private DateTime $endDate;

    private ApartmentBookingHistory $actualApartmentBookingHistory;

    public function __construct()
    {
        parent::__construct();
        self::bootKernel();
        $this->startDate = new DateTime('2021-09-09');
        $this->endDate = new DateTime('2021-09-10');

        $this->apartmentBookingHistoryRepository = $this->createMock(DoctrineApartmentBookingHistory::class);
        $this->apartmentRepository = $this->getContainer()->get(DoctrineApartmentRepository::class);

        $this->eventListener = new ApartmentBookingHistoryEventSubscriber($this->apartmentBookingHistoryRepository, $this->apartmentRepository);
    }

    public function testShouldCreateApartmentBookingHistoryWhenConsumingApartmentBooked()
    {
        $expectedAddedBookingCount = 1;
        $actualApartmentBookingIndex = 0;
        $this->givenNotExistingApartmentBookingHistory();
        $this->apartmentBookingHistoryRepository->expects($this->once())->method('save')->with(
            $this->callback(function (ApartmentBookingHistory $apartmentBookingHistory) use ($actualApartmentBookingIndex, $expectedAddedBookingCount) {

                $this->thenApartmentBookingShouldHave($apartmentBookingHistory,  $expectedAddedBookingCount,$actualApartmentBookingIndex);
                $this->actualApartmentBookingHistory = $apartmentBookingHistory;

                return true;
            })
        );

        $this->eventListener->consume($this->givenApartmentBooked());
    }

    /**
     * @depends testShouldCreateApartmentBookingHistoryWhenConsumingApartmentBooked
     */
    public function testShouldUpdateExistingApartmentBookingHistoryWhenConsumingApartmentBooked()
    {
        $expectedAddedBookingCount = 2;
        $actualApartmentBookingIndex = 1;
        $this->givenExistingApartmentBookingHistory();
        $this->apartmentBookingHistoryRepository->expects($this->once())->method('save')->with(
            $this->callback(function (ApartmentBookingHistory $apartmentBookingHistory) use ($actualApartmentBookingIndex, $expectedAddedBookingCount) {

                $this->thenApartmentBookingShouldHave($apartmentBookingHistory, $expectedAddedBookingCount,$actualApartmentBookingIndex);
                $this->actualApartmentBookingHistory = $apartmentBookingHistory;

                return true;
            })
        );

        $this->eventListener->consume($this->givenApartmentBooked());

    }

    private function givenNotExistingApartmentBookingHistory()
    {
        $this->apartmentBookingHistoryRepository->method('existsFor')->willReturn(false);
    }

    private function givenExistingApartmentBookingHistory()
    {
        $this->apartmentBookingHistoryRepository->method('existsFor')->willReturn(true);

        $apartmentBookingHistory = new ApartmentBookingHistory($this->apartmentRepository->findById(self::apartmentId));
        $apartmentBookingHistory->add(ApartmentBooking::start(new DateTime(), self::ownerId,'888', new BookingPeriod(new DateTime('2022-02-02'), new DateTime('2022-02-04')), $apartmentBookingHistory));
        $this->apartmentBookingHistoryRepository->method('findFor')->willReturn($apartmentBookingHistory);

    }
    /**
     * @throws ReflectionException
     *
     */
    private function thenApartmentBookingShouldHave(ApartmentBookingHistory $actual, int $expectedCount, int $actualApartmentBookingIndex)
    {

        $apartmentBookingList = $this->getReflectionValue(ApartmentBookingHistory::class, 'apartmentBookingList', $actual);

        $this->assertCount($expectedCount, $apartmentBookingList);

        /**
         * @var ApartmentBooking
         */
        $apartmentBooking = $apartmentBookingList[$actualApartmentBookingIndex];

        ApartmentBookingAssertion::assert($apartmentBooking)
            ->hasOwnerIdEqualTo(self::ownerId)
            ->hasTenantIdEqualTo(self::tenantId)
            ->hasBookingPeriodThatHas($this->startDate, $this->endDate);

    }

    private function givenApartmentBooked(): ApartmentBookedEvent
    {
        return ApartmentBookedEvent::create(self::apartmentId, self::ownerId, self::tenantId, $this->startDate, $this->endDate);
    }

}
