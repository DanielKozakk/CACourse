<?php

namespace Application\Apartment\ApartmentBookingHistory;

use Application\Apartment\ApartmentApplicationService;
use DataFixtures\ApartmentFixture;
use DateTime;
use Doctrine\ORM\PersistentCollection;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistoryRepository;
use Domain\Apartment\BookingRepository;
use Domain\EventChannel\EventChannel;
use Helpers\PropertiesUnwrapper;
use Infrastructure\EventChannel\Symfony\SymfonyEventDispatcher;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApartmentBookingHistoryEventSubscriberIntegrationTest extends WebTestCase
{
use PropertiesUnwrapper;
    private EventChannel $eventChannel;

    private ApartmentApplicationService $apartmentApplicationService;

    private BookingRepository $bookingRepository;

    private ApartmentBookingHistoryRepository $apartmentBookingHistoryRepository;

    public function __construct()
    {
        parent::__construct();
        self::bootKernel();
        $this->eventChannel = $this->getContainer()->get(EventChannel::class);
        $this->apartmentApplicationService = $this->getContainer()->get(ApartmentApplicationService::class);
        $this->bookingRepository = $this->getContainer()->get(BookingRepository::class);
        $this->apartmentBookingHistoryRepository = $this->getContainer()->get(ApartmentBookingHistoryRepository::class);
    }

    /**
     * @throws ReflectionException
     */
    public function testShouldUpdateApartmentBookingHistory(){
        $tenantId = '2312';
        $startDate = new DateTime('2021-01-01');
        $endDate = new DateTime('2021-01-02');

        $initialNumberOfBookings = 0;

        if($this->apartmentBookingHistoryRepository->existsFor(ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId'])){
            $initialApartmentBookingHistory = $this->apartmentBookingHistoryRepository->existsFor(ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId']);
            $initialNumberOfBookings = $this->countBookingsInApartmentBookingHistory($initialApartmentBookingHistory);
        }

       $this->apartmentApplicationService->book(ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId'], $tenantId, $startDate, $endDate);

        $apartmentBookingHistory = $this->apartmentBookingHistoryRepository->findFor(ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId']);
        $finalNumberOfBookings = $this->countBookingsInApartmentBookingHistory($apartmentBookingHistory);


        $this->assertTrue(($initialNumberOfBookings + 1 ) === ($finalNumberOfBookings));
    }

    /**
     * @throws ReflectionException
     */
    private function countBookingsInApartmentBookingHistory(ApartmentBookingHistory $apartmentBookingHistory): int
    {
        /**
         * @var PersistentCollection $apartmentBookingList
         */
        $apartmentBookingList = $this->getReflectionValue(ApartmentBookingHistory::class, 'apartmentBookingList', $apartmentBookingHistory);

        return $apartmentBookingList->count();
    }
}