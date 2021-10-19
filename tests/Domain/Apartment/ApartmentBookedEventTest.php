<?php

namespace Domain\Apartment;

use DateTime;
use PHPUnit\Framework\TestCase;

class ApartmentBookedEventTest extends TestCase
{
    const POSIX_TIME_TOLERATED_DIFFERENCE = 10;
    const UNIQ_ID_LENGTH = 13;

    public function testShouldCreateEventWithAllInformation()
    {

        $apartmentId = 1234;
        $ownerId = '5678';
        $tenantId = '3456';
        $periodStart = new DateTime('2020-01-01');
        $periodEnd = new DateTime('2021-02-02');


        $apartmentBookedEventActual = ApartmentBookedEvent::create($apartmentId, $ownerId, $tenantId, $periodStart, $periodEnd);
        $dateTimeDifferenceAbsoluteValue = abs($apartmentBookedEventActual->getCreationDateTime()->getTimestamp() - (new DateTime())->getTimestamp());

        $this->assertSame(mb_strlen($apartmentBookedEventActual->getEventId()), self::UNIQ_ID_LENGTH);
        $this->assertTrue($dateTimeDifferenceAbsoluteValue < self::POSIX_TIME_TOLERATED_DIFFERENCE);
        $this->assertSame($apartmentBookedEventActual->getApartmentId(), $apartmentId);
        $this->assertSame($apartmentBookedEventActual->getOwnerId(), $ownerId);
        $this->assertSame($apartmentBookedEventActual->getTenantId(), $tenantId);
        $this->assertSame($apartmentBookedEventActual->getStartDate(), $periodStart);
        $this->assertSame($apartmentBookedEventActual->getEndDate(), $periodEnd);

    }
}
