<?php

namespace Domain\Hotel\HotelBookingHistory;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HotelBookingHistoryTest extends KernelTestCase
{

    public function testAddingNewHotelRoomBookingHistoryToHotelBookingHistory(){

        self::bootKernel();
        $container = self::getContainer();
        $em = $container->get('doctrine.orm.entity_manager');

        self::assertTrue(true);

    }
}
