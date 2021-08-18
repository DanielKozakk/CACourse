<?php

namespace App\Tests\Domain\Apartment;

use App\Domain\Apartment\Period;
use DatePeriod;
use DateTime;
use PHPUnit\Framework\TestCase;

class PeriodTest extends TestCase
{

    public function testShouldPeriodContainsTwoDays():void{
        $start = new DateTime('2000-01-01');
        $end = new DateTime('2000-01-02');

        $period = new Period(clone($start), clone($end));

        $dateTimeArray = $period->asDateTimeArray();

        $this->assertCount(2, $dateTimeArray);
        $this->assertEquals($start, $dateTimeArray[0]);
        $this->assertEquals($end, $dateTimeArray[1]);
    }

}