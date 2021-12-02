<?php

namespace Domain\Hotel\HotelBookingHistory;


use DateTime;
use Domain\Hotel\Hotel;
use Domain\Hotel\HotelRepository;
use Domain\Hotel\HotelRoom\HotelRoom;
use Helpers\PropertiesUnwrapper;
use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Generator;

class HotelBookingHistoryTest extends KernelTestCase
{
    use PropertiesUnwrapper;

    const HOTEL_ID = 1;
    const HOTEL_ROOM_ID = 1;
    const TENANT_ID = '231';

    /**
     * @dataProvider dataProvider
     * @throws ReflectionException
     */
    public function testAddingNewHotelRoomBookingHistoryToHotelBookingHistory(Hotel $hotel, HotelRoom $hotelRoom, DateTime $creationDateTime, string $tenantId, array $days){
        self::bootKernel();

        $hotelBookingHistory = new HotelBookingHistory($hotel);
        $hotelBookingHistory->add($hotelRoom, $creationDateTime, $tenantId, $days);

        $hotelRoomBookingHistories = $this->getReflectionValue(HotelBookingHistory::class, 'hotelRoomBookingHistories', $hotelBookingHistory);
        $this->assertCount(1, $hotelRoomBookingHistories);

        $hotelRoomBooking = $this->getReflectionValue(HotelRoomBookingHistory::class, 'bookings', $hotelRoomBookingHistories[0])->last();

        $this->assertEquals($creationDateTime, $this->getReflectionValue(HotelRoomBooking::class, 'eventCreationDateTime', $hotelRoomBooking));
        $this->assertEquals($tenantId, $this->getReflectionValue(HotelRoomBooking::class, 'tenantId', $hotelRoomBooking));
        $this->assertEquals($days, $this->getReflectionValue(HotelRoomBooking::class, 'days', $hotelRoomBooking));
    }

    public function dataProvider(): Generator
    {
        $hotelRoom = $this->getRelatedHotelRoom();
        $hotel = $this->getRelatedHotel();
        $days = [
            DateTime::createFromFormat('d-m-Y', '01-01-1995'),
            DateTime::createFromFormat('d-m-Y', '02-01-1995')
        ];

        yield[$hotel, $hotelRoom, new DateTime(), self::TENANT_ID, $days];
    }

    private function getRelatedHotel() : Hotel{
        $container = self::getContainer();
        /** @var HotelRepository $hotelRepository */
        $hotelRepository = $container->get(DoctrineHotelRepository::class);
        return  $hotelRepository->findHotelById(self::HOTEL_ID);
    }

    private function getRelatedHotelRoom() : HotelRoom{
        $container = self::getContainer();
        /** @var HotelRepository $hotelRepository */
        $hotelRepository = $container->get(DoctrineHotelRepository::class);

        return $hotelRepository->findHotelRoomById(self::HOTEL_ROOM_ID);
    }
}
