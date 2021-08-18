<?php

namespace App\Tests\Domain\Apartment;

use App\Domain\Apartment\Period;
use DatePeriod;
use DateTime;
use PHPUnit\Framework\TestCase;

class PeriodTest extends TestCase
{
    /**
     * @param string $expectedStartDate
     * @param string $expectedEndDate
     * @param int $expectedCount
     * @param array $expectedArrayOfDays
     * @throws \Exception
     * @dataProvider dataProvider
     */

    public function testShouldPeriodContains(string $expectedStartDate, string $expectedEndDate, int $expectedCount, array $expectedArrayOfDays): void
    {
        $start = new DateTime($expectedStartDate);
        $end = new DateTime($expectedEndDate);

        $period = new Period(clone($start), clone($end));
        $dateTimeArray = $period->asDateTimeArray();

        $this->assertCount($expectedCount, $dateTimeArray);
        $this->assertEqualsCanonicalizing(
                $expectedArrayOfDays,
                $dateTimeArray
        );
    }

    public function dataProvider(): \Generator
    {
        $expectedDate = '2000-01-01';
        $expectedEnd = '2000-01-01';
        $expectedCount = 1;
        $expectedArray = [
            new DateTime('2000-01-01')
        ];
        yield [$expectedDate, $expectedEnd, $expectedCount, $expectedArray];

        $expectedDate = '2000-01-01';
        $expectedEnd = '2000-01-02';
        $expectedCount = 2;
        $expectedArray = [
            new DateTime('2000-01-01'),
            new DateTime('2000-01-02')
        ];
        yield [$expectedDate, $expectedEnd, $expectedCount, $expectedArray];

        $expectedDate = '2021-08-08';
        $expectedEnd = '2021-08-14';
        $expectedCount = 7;
        $expectedArray = [
            new DateTime('2021-08-08'),
            new DateTime('2021-08-09'),
            new DateTime('2021-08-10'),
            new DateTime('2021-08-11'),
            new DateTime('2021-08-12'),
            new DateTime('2021-08-13'),
            new DateTime('2021-08-14'),
        ];
        yield [$expectedDate, $expectedEnd, $expectedCount, $expectedArray];

    }

}