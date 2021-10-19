<?php

namespace Application\Apartment\ApartmentBookingHistory;

use DataFixtures\ApartmentFixture;
use DateTime;
use Domain\Apartment\ApartmentBookedEvent;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApartmentBookingHistoryEventSubscriberTest extends WebTestCase
{
    private ApartmentBookingHistoryEventSubscriber $eventListener;

    private const apartmentId = ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId'];
    private const ownerId = ApartmentFixture::FIRST_TEST_APARTMENT['ownerId'];
    private const tenantId = '12345678910';
    private DateTime $startDate;
    private DateTime $endDate;


    public function __construct()
    {
        parent::__construct();
        $this->startDate = new DateTime('2021-09-09');
        $this->endDate = new DateTime('2021-09-10');

        self::bootKernel();
        $this->eventListener = $this->getContainer()->get(ApartmentBookingHistoryEventSubscriber::class);
    }

    public function testShouldCreateApartmentBookingHistoryWhenConsumingApartmentBooked(){

        $this->eventListener->consume($this->givenApartmentBooked());

    }

    public function testShouldUpdateExistingApartmentBookingHistoryWhenConsumingApartmentBooked(){
        $this->eventListener->consume($this->givenApartmentBooked());

    }

    private function givenApartmentBooked(): ApartmentBookedEvent
    {
        return ApartmentBookedEvent::create(self::apartmentId, self::ownerId, self::tenantId, $this->startDate, $this->endDate);
    }
}
