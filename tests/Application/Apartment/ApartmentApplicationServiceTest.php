<?php

namespace Application\Apartment;

use DataFixtures\ApartmentFixture;
use DateTime;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentAssertion;
use Domain\Apartment\ApartmentRepository;
use Domain\Apartment\Booking;
use Domain\Apartment\BookingAssertion;
use Domain\Apartment\BookingRepository;
use Domain\Apartment\RentalType;
use Domain\EventChannel\EventChannel;
use Infrastructure\Persistence\Doctrine\Apartment\DoctrineApartmentRepository;
use Infrastructure\Persistence\Doctrine\Booking\DoctrineBookingRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApartmentApplicationServiceTest extends WebTestCase
{

    private ApartmentApplicationService $apartmentApplicationService;
    private ApartmentRepository $apartmentRepository;
    private EventChannel $eventChannel;
    private BookingRepository $bookingRepository;

    private const APARTMENT_ID = ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId'];
    private const OWNER_ID = ApartmentFixture::FIRST_TEST_APARTMENT['ownerId'];
    private const STREET = ApartmentFixture::FIRST_TEST_APARTMENT['street'];
    private const POSTAL_CODE = ApartmentFixture::FIRST_TEST_APARTMENT['postalCode'];
    private const HOUSE_NUMBER = ApartmentFixture::FIRST_TEST_APARTMENT['houseNumber'];
    private const APARTMENT_NUMBER = ApartmentFixture::FIRST_TEST_APARTMENT['apartmentNumber'];
    private const CITY = ApartmentFixture::FIRST_TEST_APARTMENT['city'];
    private const COUNTRY = ApartmentFixture::FIRST_TEST_APARTMENT['country'];
    private const DESCRIPTION = ApartmentFixture::FIRST_TEST_APARTMENT['description'];
    private const ROOMS_DEFINITION = ApartmentFixture::FIRST_TEST_APARTMENT['roomsDefinition'];

    private const TENANT_ID = '3203';
    private DateTime $bookingStart;
    private DateTime $bookingEnd;


    public function __construct()
    {
        parent::__construct();
        self::bootKernel();

        $this->bookingStart = new DateTime('2021-01-02');
        $this->bookingEnd = new DateTime('2021-01-03');

        $this->apartmentRepository = $this->createMock(ApartmentRepository::class);
        $this->eventChannel = $this->createStub(EventChannel::class);
        $this->bookingRepository = $this->createMock(DoctrineBookingRepository::class);

        $this->apartmentApplicationService = new ApartmentApplicationService($this->apartmentRepository, $this->eventChannel, $this->bookingRepository);
    }

    public function testShouldCreateApartmentWithAllParameters()
    {
        $this->apartmentRepository->expects($this->once())->method('save')->with($this->callback(
            function (Apartment $apartment) {
                ApartmentAssertion::assert($apartment)
                    ->hasOwnerIdEqualsTo(self::OWNER_ID)
                    ->hasAddressEqualsTo(self::STREET, self::POSTAL_CODE, self::HOUSE_NUMBER, self::APARTMENT_NUMBER, self::CITY, self::COUNTRY)
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

    private function givenApartmentWithId(int $id)
    {
        $apartment = $this->getContainer()->get(DoctrineApartmentRepository::class)->findById($id);
        $this->apartmentRepository->method('findById')->willReturn($apartment);
    }

    public function testShouldBookApartmentWithAllParameters()
    {
        $this->givenApartmentWithId(self::APARTMENT_ID);

        $this->bookingRepository->expects($this->once())->method('save')->with(
            $this->callback(
                function (Booking $booking){

                    BookingAssertion::assert($booking)
                        ->isOpen()
                        ->hasTenantIdEqualsTo(self::TENANT_ID)
                        ->hasRentalTypeEqualsTo(RentalType::apartmentRentalType()->getState())
                        ->hasRentalPlaceIdEqualsTo(self::APARTMENT_ID)
                        ->hasDaysEqualsTo([$this->bookingStart, $this->bookingEnd]);
                    return true;
                }
            )
        );

        $this->apartmentApplicationService->book(self::APARTMENT_ID, self::TENANT_ID, $this->bookingStart, $this->bookingEnd);
    }
}
