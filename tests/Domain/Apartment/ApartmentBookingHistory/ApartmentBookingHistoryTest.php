<?php

namespace Domain\Apartment\ApartmentBookingHistory;

use DateTime;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentRepository;
use Helpers\PropertiesUnwrapper;
use Infrastructure\Persistence\Doctrine\Apartment\DoctrineApartmentRepository;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ApartmentBookingHistoryTest extends KernelTestCase
{
    use PropertiesUnwrapper;
    private const APARTMENT_ID = 1;

    /**
     * @throws ReflectionException
     */
    public function testShouldAddApartmentBookingToApartmentBookingHistory()
    {

        $bookingCreation = new DateTime();
        $ownerId = '9090';
        $tenantId = '5535';

        $bookingStart = DateTime::createFromFormat('d-m-Y', '09-09-2009');
        $bookingEnd = DateTime::createFromFormat('d-m-Y', '10-09-2009');
        $bookingPeriod = new BookingPeriod($bookingStart, $bookingEnd);

        $apartmentBookingHistory = new ApartmentBookingHistory($this->getRelatedApartment());
        $apartmentBooking = ApartmentBooking::start($bookingCreation,$ownerId, $tenantId, $bookingPeriod, $apartmentBookingHistory);

        $apartmentBookingHistory->add($apartmentBooking);

        $this->assertEquals($apartmentBooking, $this->getReflectionValue(ApartmentBookingHistory::class, 'apartmentBookingList', $apartmentBookingHistory)->first());

        $this->assertSame($bookingCreation,$this->getReflectionValue(ApartmentBooking::class, 'bookingCreation', $apartmentBooking) );
        $this->assertSame($ownerId,$this->getReflectionValue(ApartmentBooking::class, 'ownerId', $apartmentBooking) );
        $this->assertSame($tenantId,$this->getReflectionValue(ApartmentBooking::class, 'tenantId', $apartmentBooking) );
        $this->assertSame($bookingPeriod,$this->getReflectionValue(ApartmentBooking::class, 'bookingPeriod', $apartmentBooking) );
        $bookingStep = $this->getReflectionValue(ApartmentBooking::class, 'bookingStep', $apartmentBooking);
        $this->assertSame('START', $this->getReflectionValue(BookingStep::class, 'state', $bookingStep));
    }

    private function getRelatedApartment(): Apartment
    {
        self::bootKernel();

        $container = self::getContainer();

        /**
         * @var ApartmentRepository
         */
        $apartmentRepository = $container->get(DoctrineApartmentRepository::class);

        return $apartmentRepository->findById(self::APARTMENT_ID);
    }
}
