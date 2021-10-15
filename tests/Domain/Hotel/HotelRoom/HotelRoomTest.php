<?php

namespace Domain\Hotel\HotelRoom;

use Doctrine\Common\Collections\ArrayCollection;
use Domain\Hotel\Hotel;
use Domain\Hotel\HotelAddress;
use Domain\Hotel\HotelRepository;
use Helpers\PropertiesUnwrapper;
use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HotelRoomTest extends KernelTestCase
{
    use PropertiesUnwrapper;

    private int $hotelId = 1;
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

        return $hotelRoomFactory->create($this->hotelId, $this->hotelRoomNumber, $this->spacesDefinition, $this->description);
    }

    private function getRelatedHotel(): ?Hotel
    {
        $container = self::getContainer();
        /**
         * @var DoctrineHotelRepository $hotelRepository
         */
        $hotelRepository = $container->get(DoctrineHotelRepository::class);
        return $hotelRepository->findById($this->hotelId);
    }
}
