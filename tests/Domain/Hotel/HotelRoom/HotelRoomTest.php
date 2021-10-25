<?php

namespace Domain\Hotel\HotelRoom;

use DataFixtures\HotelFixture;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Domain\Apartment\Booking;
use Domain\Apartment\RentalType;
use Domain\EventChannel\EventChannel;
use Domain\Hotel\Hotel;
use Domain\Hotel\HotelAddress;
use Domain\Hotel\HotelRepository;
use Helpers\PropertiesUnwrapper;
use Infrastructure\EventChannel\Symfony\SymfonyEventDispatcher;
use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HotelRoomTest extends WebTestCase
{
    use PropertiesUnwrapper;

    private int $hotelRoomNumber = 1;
    private array $spacesDefinition = ['kuchnia' => 24, 'łazienka' => 42.5];
    private string $description = 'Opis hotel roomu';

    /**
     * @throws ReflectionException
     */
    public function testShouldCreateHotelRoomFactory(){
        self::bootKernel();

        $actualHotelRoom = $this->createNewHotelRoom();

        $actualHotel = $this->getReflectionValue(HotelRoom::class,'hotel', $actualHotelRoom);
        $actualHotelRoomNumber = $this->getReflectionValue(HotelRoom::class, 'hotelRoomNumber', $actualHotelRoom);
        $actualDescription = $this->getReflectionValue(HotelRoom::class, 'description', $actualHotelRoom);
        $actualSpaces = $this->getReflectionValue(HotelRoom::class, 'spaces', $actualHotelRoom);

        $this->assertSame($this->getRelatedHotel(), $actualHotel);
        $this->assertSame($this->hotelRoomNumber, $actualHotelRoomNumber);
        $this->assertSame($this->description, $actualDescription);


        $this->assertEqualsCanonicalizing($this->spacesDefinition, $this->changeSpacesToArrayOfSpaces($actualSpaces));

    }

    /**
     * @throws ReflectionException
     */
    public function testShouldCreateNewBookingObjectWithAllRequiredFields(){
        $tenantId = '12354';
        $days = [new DateTime('2021-09-20'), new DateTime('2021-09-21')];

        $eventChannel = $this->createMock(EventChannel::class);

        /**
         * @var HotelRoom $hotelRoom
         */
        $hotelRoom = $this->getTestHotelRoomFromDatabase();
        $hotelRoomId = $this->getReflectionValue(HotelRoom::class, 'id', $hotelRoom);
        /**
         * @var Hotel $hotel
         */
        $hotel = $this->getReflectionValue(HotelRoom::class, 'hotel', $hotelRoom);
        $hotelId = $hotel->getId();



        $eventChannel->expects($this->once())->method('publishHotelRoomBookedEvent')->with($this->callback(
            function (HotelRoomBookedEvent $hotelRoomBookedEvent) use ($tenantId, $days, $hotelId, $hotelRoomId) {
                $this->assertEquals($hotelRoomId, $hotelRoomBookedEvent->getHotelRoomId());
                $this->assertEquals($hotelId, $hotelRoomBookedEvent->getHotelId());
                $this->assertEquals($tenantId, $hotelRoomBookedEvent->getTenantId());
                $this->assertEqualsCanonicalizing($days, $hotelRoomBookedEvent->getDays());
                return true;
            }
        ));

        $booking = $hotelRoom->book($tenantId,$days, $eventChannel);

        /**
         * @var RentalType
         */
        $actualRentalType = $this->getReflectionValue(Booking::class, 'rentalType', $booking);
        $this->assertEquals(RentalType::HOTEL_ROOM, $actualRentalType->getState());

        $actualTenantId = $this->getReflectionValue(Booking::class, 'tenantId', $booking);
        $this->assertEquals($tenantId, $actualTenantId);
        $actualDays = $this->getReflectionValue(Booking::class, 'days', $booking);
        $this->assertEqualsCanonicalizing($days, $actualDays);

    }

    /**
     * @throws ReflectionException
     */
    private function changeSpacesToArrayOfSpaces(ArrayCollection $spacesCollection): array{

        $spacesDefinition = [];
        foreach($spacesCollection->toArray() as $spaceEntity){
            $name = $this->getReflectionValue(Space::class, 'name', $spaceEntity);
            $squareMeterEntity = $this->getReflectionValue(Space::class, 'squareMeter', $spaceEntity);
            $squareMeterSize = $this->getReflectionValue(SquareMeter::class, 'size', $squareMeterEntity);

            $spacesDefinition[$name] = $squareMeterSize;
        }
        return $spacesDefinition;
    }

    private function createNewHotelRoom(): HotelRoom
    {
        $container = self::getContainer();

        /**
         * @var HotelRoomFactory $hotelRoomFactory
         */
        $hotelRoomFactory = $container->get(HotelRoomFactory::class);
        /**
         * Hotel $hotel
         */
        $hotel = $this->getRelatedHotel();
        $hotelId = $this->getReflectionValue(Hotel::class, 'id', $hotel);

        return $hotelRoomFactory->create($hotelId, $this->hotelRoomNumber, $this->spacesDefinition, $this->description);
    }

    private function getRelatedHotel(): ?Hotel
    {
        $container = self::getContainer();
        /**
         * @var DoctrineHotelRepository $hotelRepository
         */
        $hotelRepository = $container->get(DoctrineHotelRepository::class);
        return $hotelRepository->findById(HotelFixture::HOTEL_ID);
    }

    private function getTestHotelRoomFromDatabase(){

        return $this->getContainer()->get(HotelRoomRepository::class)->findById(HotelFixture::HOTEL_ROOM_ID);
    }
}
