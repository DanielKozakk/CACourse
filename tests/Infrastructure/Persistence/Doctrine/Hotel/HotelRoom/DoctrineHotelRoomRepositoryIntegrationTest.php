<?php

namespace Infrastructure\Persistence\Doctrine\Hotel\HotelRoom;

use Domain\Hotel\Hotel;
use Domain\Hotel\HotelFactory;
use Domain\Hotel\HotelRepository;
use Domain\Hotel\HotelRoom\HotelRoom;
use Domain\Hotel\HotelRoom\HotelRoomAssertion;
use Domain\Hotel\HotelRoom\HotelRoomFactory;
use Helpers\PropertiesUnwrapper;
use Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DoctrineHotelRoomRepositoryIntegrationTest extends WebTestCase
{
    use PropertiesUnwrapper;

    private DoctrineHotelRepository $doctrineHotelRepository;
    private DoctrineHotelRoomRepository $doctrineHotelRoomRepository;

    private const HOTEL_ROOM_NUMBER = '1234';
    private const SPACES_DEFINITION = ['FIRST_SPACE' => 201.4, 'SECOND_SPACE' => 20];
    private const DESCRIPTION = 'IT IS DESCRIPTION';


    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        self::bootKernel();
        $this->doctrineHotelRepository = $this->getContainer()->get(DoctrineHotelRepository::class);
        $this->doctrineHotelRoomRepository = $this->getContainer()->get(DoctrineHotelRoomRepository::class);
    }

    /**
     * @throws ReflectionException
     */
    public function testShouldSaveHotelRoomWithAllFields()
    {
        $hotel = $this->givenHotel();
        $hotelId = $this->getReflectionValue(Hotel::class, 'id', $hotel);
        $hotelRoom = $this->givenHotelRoom($hotel);
        $this->doctrineHotelRoomRepository->save($hotelRoom);

        $hotelRoomId = $this->getReflectionValue(HotelRoom::class, 'id', $hotelRoom);

        $fetchedHotelRoom = $this->doctrineHotelRoomRepository->findById($hotelRoomId);

        HotelRoomAssertion::assert($fetchedHotelRoom)
            ->hasSpacesEqualTo(self::SPACES_DEFINITION)
            ->hasDescriptionEqualTo(self::DESCRIPTION)
            ->hasHotelRoomNumberEqualTo(self::HOTEL_ROOM_NUMBER)
            ->hasHotelIdEqualTo($hotelId);
    }

    /**
     * @throws ReflectionException
     */
    private function givenHotelRoom(Hotel $hotel ): HotelRoom
    {
        $hotelRoomFactory = new HotelRoomFactory($this->doctrineHotelRepository);
        $hotelId = $this->getReflectionValue(Hotel::class, 'id', $hotel);

        return $hotelRoomFactory->create($hotelId, self::HOTEL_ROOM_NUMBER, self::SPACES_DEFINITION, self::DESCRIPTION);
    }


    private function givenHotel(): Hotel
    {
        $hotelName = 'hotel name';
        $hotelStreet = 'hotel street';
        $hotelPostalCode = '21-1221';
        $hotelFlatNumber = '2212a';
        $hotelCity = 'Rzeszów';
        $hotelCountry = 'Polska';

        $hotelFactory = new HotelFactory();
        $hotel = $hotelFactory->create($hotelName, $hotelStreet, $hotelPostalCode, $hotelFlatNumber, $hotelCity, $hotelCountry);

        $this->doctrineHotelRepository->save($hotel);
        return $hotel;
    }

}
