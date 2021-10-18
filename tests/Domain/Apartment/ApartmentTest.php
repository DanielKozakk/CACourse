<?php

namespace Domain\Apartment;

use DataFixtures\ApartmentFixture;
use DateTime;
use Domain\EventChannel\EventChannel;
use Infrastructure\Persistence\Doctrine\Apartment\DoctrineApartmentRepository;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use ReflectionProperty;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApartmentTest extends WebTestCase
{
    const TENANT_ID = '9876';

    private DateTime $periodStart;
    private DateTime $periodEnd;

    private Period $period;

    public function __construct()
    {
        parent::__construct();
        $this->periodStart = new DateTime('2021-01-01');
        $this->periodEnd = new DateTime('2021-01-02');
        $this->period = new Period($this->periodStart, $this->periodEnd);
    }

    public function testShouldCreateApartmentWithAllInformation()
    {
        ApartmentAssertion::assert($this->getApartment())
            ->hasOwnerIdEqualsTo(ApartmentFixture::FIRST_TEST_APARTMENT['ownerId'])
            ->hasDescriptionEqualsTo(ApartmentFixture::FIRST_TEST_APARTMENT['description'])
            ->hasRoomsEqualsTo(ApartmentFixture::FIRST_TEST_APARTMENT['roomsDefinition'])
            ->hasAddressEqualsTo(
                ApartmentFixture::FIRST_TEST_APARTMENT['street'],
                ApartmentFixture::FIRST_TEST_APARTMENT['postalCode'],
                ApartmentFixture::FIRST_TEST_APARTMENT['houseNumber'],
                ApartmentFixture::FIRST_TEST_APARTMENT['apartmentNumber'],
                ApartmentFixture::FIRST_TEST_APARTMENT['city'],
                ApartmentFixture::FIRST_TEST_APARTMENT['country'],
            );
    }


    /**
     * @throws ReflectionException
     */
    public function shouldCreateBookingOnceBooked()
    {
        $apartment = $this->getApartment();
        /**
         * @var EventChannel
         */
        $eventChannel = '';
        $actual = $apartment->book(self::TENANT_ID, $this->period, $eventChannel);

        BookingAssertion::assert($actual)
            ->isOpen()
            ->hasRentalTypeEqualsTo(RentalType::APARTMENT)
            ->hasRentalPlaceIdEqualsTo(ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId'])
            ->hasTenantIdEqualsTo(self::TENANT_ID)
            ->hasDaysEqualsTo([$this->periodStart, $this->periodEnd]);

        $this->assertTrue(true);
    }

    private function getApartment(): Apartment
    {
        self::bootKernel();
        $container = self::getContainer();
        /**
         * @var DoctrineApartmentRepository $hotelRepository
         */
        $hotelRepository = $container->get(DoctrineApartmentRepository::class);
        return $hotelRepository->findById(ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId']);
    }
}
