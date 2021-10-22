<?php

namespace Application\Apartment;

use DataFixtures\ApartmentFixture;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentAssertion;
use Domain\Apartment\ApartmentRepository;
use Domain\Apartment\Booking;
use Domain\Apartment\BookingAssertion;
use Domain\Apartment\BookingRepository;
use Domain\EventChannel\EventChannel;
use Infrastructure\Persistence\Doctrine\Booking\DoctrineBookingRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApartmentApplicationServiceTest extends WebTestCase
{

    private ApartmentApplicationService $apartmentApplicationService;
    private ApartmentRepository $apartmentRepository;
    private EventChannel $eventChannel;
    private BookingRepository $bookingRepository;

    private const OWNER_ID = ApartmentFixture::FIRST_TEST_APARTMENT['ownerId'];
    private const STREET = ApartmentFixture::FIRST_TEST_APARTMENT['street'];
    private const POSTAL_CODE = ApartmentFixture::FIRST_TEST_APARTMENT['postalCode'];
    private const HOUSE_NUMBER = ApartmentFixture::FIRST_TEST_APARTMENT['houseNumber'];
    private const APARTMENT_NUMBER = ApartmentFixture::FIRST_TEST_APARTMENT['apartmentNumber'];
    private const CITY = ApartmentFixture::FIRST_TEST_APARTMENT['city'];
    private const COUNTRY = ApartmentFixture::FIRST_TEST_APARTMENT['country'];
    private const DESCRIPTION = ApartmentFixture::FIRST_TEST_APARTMENT['description'];
    private const ROOMS_DEFINITION = ApartmentFixture::FIRST_TEST_APARTMENT['roomsDefinition'];

    public function __construct()
    {
        parent::__construct();
        self::bootKernel();

        $this->apartmentRepository = $this->createMock(ApartmentRepository::class);
        $this->eventChannel = $this->createStub(EventChannel::class);
        $this->bookingRepository = $this->getContainer()->get(DoctrineBookingRepository::class);

        $this->apartmentApplicationService = new ApartmentApplicationService($this->apartmentRepository, $this->eventChannel, $this->bookingRepository);
    }

    public function testAddApartment()
    {
        $this->apartmentRepository->expects($this->once())->method('save')->with($this->callback(
            function (Apartment $apartment){
                ApartmentAssertion::assert($apartment)
                    ->hasOwnerIdEqualsTo(self::OWNER_ID)
                    ->hasAddressEqualsTo(self::STREET, self::POSTAL_CODE,self::HOUSE_NUMBER, self::APARTMENT_NUMBER, self::CITY, self::COUNTRY)
                    ->hasRoomsEqualsTo(self::ROOMS_DEFINITION);
                return true;
            }
        ));

        $this->apartmentApplicationService->addApartment(self::OWNER_ID,
            self::STREET,
            self::POSTAL_CODE,
            self::HOUSE_NUMBER,
            self::APARTMENT_NUMBER,
            self::CITY,
            self::COUNTRY,
            self::DESCRIPTION,
            self::ROOMS_DEFINITION);
    }
}
