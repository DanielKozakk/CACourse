<?php

namespace App\Tests\Domain\Apartment;

use App\Domain\Apartment\ApartmentBookedEvent;
use App\Domain\Apartment\Period;
use DateTime;
use PHPUnit\Framework\TestCase;

class ApartmentBookedEventTest extends TestCase
{

    const POSIX_TIME_TOLERATED_DIFFERENCE = 10;
    const UNIQ_ID_LENGTH = 13;


    public function testShouldCreateEventWithAllInformation()
    {
        $apartmentId = '1234';
        $ownerId = '5678';
        $tenantId = '3456';
        $periodStart = new DateTime('2020-01-01');
        $periodEnd = new DateTime('2021-02-02');
        $period = new Period($periodStart, $periodEnd);


//string $apartmentId, string $ownerId, string $tenantId, Period $period
        $actual = ApartmentBookedEvent::create($apartmentId, $ownerId, $tenantId, $period);

        $dateTimeDifferenceAbsoluteValue = abs($actual->getCreationDateTime()->getTimestamp() - (new DateTime())->getTimestamp());

        $this->assertSame(mb_strlen($actual->getEventId()), self::UNIQ_ID_LENGTH);
        $this->assertTrue($dateTimeDifferenceAbsoluteValue < self::POSIX_TIME_TOLERATED_DIFFERENCE);
        $this->assertSame($actual->getApartmentId(), $apartmentId);
        $this->assertSame($actual->getOwnerId(), $ownerId);
        $this->assertSame($actual->getTenantId(), $tenantId);
        $this->assertSame($actual->getPeriodStart(), $periodStart);
        $this->assertSame($actual->getPeriodEnd(), $periodEnd);
    }
}
