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

    public function testShouldPeriodContainsSevenDays():void{
        $start = new DateTime('2021-08-08');
        $end = new DateTime('2021-08-14');

        $period = new Period(clone($start), clone($end));
        $dateTimeArray = $period->asDateTimeArray();

        $this->assertCount(7, $dateTimeArray);
        $this->assertEqualsCanonicalizing(
            [new DateTime('2021-08-08'),
            new DateTime('2021-08-09'),
            new DateTime('2021-08-10'),
            new DateTime('2021-08-11'),
            new DateTime('2021-08-12'),
            new DateTime('2021-08-13'),
            new DateTime('2021-08-14')],
            $dateTimeArray
        );
    }

}