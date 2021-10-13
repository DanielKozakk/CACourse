<?php

namespace Domain\Hotel\HotelBookingHistory;

use Cassandra\Date;
use DateTime;
use Domain\Hotel\Hotel;
use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HotelBookingHistoryTest extends KernelTestCase
{
    const HOTEL_ID = 1;


    public function testAddingNewHotelRoomBookingHistoryToHotelBookingHistory(){

        $creationDateTime = new DateTime();

        self::bootKernel();
        $container = self::getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $hotelRepository = $container->get(DoctrineHotelRepository::class);
        $hotel = $hotelRepository->findById(self::HOTEL_ID);


        dump($hotel);
        self::assertTrue(true);


    }
}
