<?php
declare(strict_types = 1);

namespace App\Tests\Domain\Apartment;

use App\Domain\Apartment\Address;
use App\Domain\Apartment\Apartment;
use App\Domain\Apartment\ApartmentBookedEvent;
use App\Domain\Apartment\ApartmentFactory;
use App\Domain\Apartment\BookingAcceptedEvent;
use App\Domain\Apartment\Period;
use App\Domain\Apartment\RentalType;
use App\Domain\Apartment\Room;
use App\Domain\Apartment\SquareMeter;
use DateTime;
use PHPUnit\Framework\TestCase;
use ReflectionObject;
use ReflectionProperty;

class BookingAcceptedEventTest extends TestCase
{
    const POSIX_TIME_TOLERATED_DIFFERENCE = 10;
    const UNIQ_ID_LENGTH = 13;

    public function testShouldCreateBookingAcceptedEventWithAllInformation()
    {

        $expectedRentalType = new RentalType(RentalType::APARTMENT);
        $expectedRentalPlaceId='1234';
        $expectedTenantId='5678';
        $expectedDays = [new DateTime('2021-01-01'),new DateTime('2021-01-02')];

        $actual = BookingAcceptedEvent::create($expectedRentalType, $expectedRentalPlaceId, $expectedTenantId, $expectedDays);

        $dateTimeDifferenceAbsoluteValue = abs($actual->getCreationDateTime()->getTimestamp() - (new DateTime())->getTimestamp());

        $this->assertSame(mb_strlen($actual->getEventId()), self::UNIQ_ID_LENGTH);
        $this->assertTrue($dateTimeDifferenceAbsoluteValue < self::POSIX_TIME_TOLERATED_DIFFERENCE);
        $this->assertSame($actual->getRentalType(), 'APARTMENT');
        $this->assertSame($actual->getRentalPlaceId(), $expectedRentalPlaceId);
        $this->assertSame($actual->getTenantId(), $expectedTenantId);
        $this->assertSame($actual->getDays(), $expectedDays);
    }
}
