<?php

namespace Domain\Hotel\HotelRoom;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Domain\Hotel\Hotel;
use Helpers\PropertiesUnwrapper;
use PHPUnit\Framework\Assert;
use ReflectionException;

class HotelRoomAssertion extends Assert
{
    use PropertiesUnwrapper;
    private HotelRoom $actual;

    private function __construct(HotelRoom $actual)
    {
        $this->actual= $actual;
    }

    public static function assert(HotelRoom $actual): self{
        return new HotelRoomAssertion($actual);
    }

    /**
     * @throws ReflectionException
     */public function hasHotelIdEqualTo(int $expectedHotelId): static
{
        $actualHotel = $this->getReflectionValue(HotelRoom::class, 'hotel', $this->actual);
        $actualHotelId = $this->getReflectionValue(Hotel::class, 'id', $actualHotel);
        $this->assertSame($expectedHotelId, $actualHotelId);
        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public function hasHotelRoomNumberEqualTo (int $expectedHotelRoomNumber): static
    {

         $actualHotelRoomNumber = $this->getReflectionValue(HotelRoom::class, 'hotelRoomNumber', $this->actual);
         $this->assertSame($expectedHotelRoomNumber, $actualHotelRoomNumber);
         return $this;
    }

    /**
     * @throws ReflectionException
     */public function hasSpacesEqualTo(array $expectedSpaces): static
{
        $actualSpaces = $this->getReflectionValue(HotelRoom::class, 'spaces', $this->actual);
        $actualSpaces = $this->changeSpacesToArrayOfSpaces($actualSpaces);

        $this->assertEqualsCanonicalizing($expectedSpaces, $actualSpaces);
        return $this;
     }

    /**
     * @throws ReflectionException
     */
    public function hasDescriptionEqualTo(string $expectedDescription): static
    {
         $actualDescription = $this->getReflectionValue(HotelRoom::class, 'description', $this->actual);
         $this->assertEquals($expectedDescription, $actualDescription);
         return $this;
     }

     /**
      * @throws ReflectionException
      */
    private function changeSpacesToArrayOfSpaces(ArrayCollection|PersistentCollection $spacesCollection): array{

        $spacesDefinition = [];
        foreach($spacesCollection->toArray() as $spaceEntity){
            $name = $this->getReflectionValue(Space::class, 'name', $spaceEntity);
            $squareMeterEntity = $this->getReflectionValue(Space::class, 'squareMeter', $spaceEntity);
            $squareMeterSize = $this->getReflectionValue(SquareMeter::class, 'size', $squareMeterEntity);

            $spacesDefinition[$name] = $squareMeterSize;
        }
        return $spacesDefinition;
    }

}