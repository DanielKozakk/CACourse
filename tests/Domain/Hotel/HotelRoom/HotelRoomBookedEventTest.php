<?php

namespace Domain\Hotel\HotelRoom;

use DateTime;
use PHPUnit\Framework\TestCase;

class HotelRoomBookedEventTest extends TestCase
{

    const POSIX_TIME_TOLERATED_DIFFERENCE = 10;
    const UNIQ_ID_LENGTH = 13;


    public function testShouldCreateEventWithAllInformation(){
        $hotelRoomId = 2;
        $hotelId = 1;
        $tenantId = '3456';
        $days = [new DateTime('2020-01-01'), new DateTime('2021-02-02') ];

        $actualHotelRoomBookedEvent = HotelRoomBookedEvent::create($hotelRoomId, $hotelId, $tenantId, $days);

        $this->assertSame(mb_strlen($actualHotelRoomBookedEvent->getEventId()), self::UNIQ_ID_LENGTH);

        $dateTimeDifferenceAbsoluteValue = abs($actualHotelRoomBookedEvent->getEventCreationDateTime()->getTimestamp() - (new DateTime())->getTimestamp());
        $this->assertTrue($dateTimeDifferenceAbsoluteValue < self::POSIX_TIME_TOLERATED_DIFFERENCE);

        $this->assertSame($actualHotelRoomBookedEvent->getHotelRoomId(), $hotelRoomId);
        $this->assertSame($actualHotelRoomBookedEvent->getHotelId(), $hotelId);
        $this->assertSame($actualHotelRoomBookedEvent->getTenantId(), $tenantId);
        $this->assertEqualsCanonicalizing($actualHotelRoomBookedEvent->getDays(), $days);
 

    }
}
