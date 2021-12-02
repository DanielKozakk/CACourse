<?php

namespace Application\Hotel;

use Domain\Hotel\Hotel;
use Domain\Hotel\HotelAssertion;
use Domain\Hotel\HotelRepository;
use PHPUnit\Framework\TestCase;

class HotelApplicationServiceTest extends TestCase
{

    private const NAME = 'Test Name';
    private const STREET = 'Test STREET';
    private const POSTAL_CODE = 'Test postalCode';
    private const BUILDING_NUMBER = 'Test flat number';
    private const CITY = 'City';
    private const COUNTRY = 'COUNTRY';

    public function testShouldHotelWithAllFields()
    {

        $hotelRepository = $this->createMock(HotelRepository::class);

        $hotelApplicationService = new HotelApplicationService($hotelRepository);

        $hotelRepository->expects($this->once())->method('saveHotel')->with($this->callback(
            function (Hotel $hotel){
                HotelAssertion::assert($hotel)
                    ->hasNameEqualTo(self::NAME)
                    ->hasAddressEqualTo(self::STREET, self::POSTAL_CODE, self::BUILDING_NUMBER, self::CITY, self::COUNTRY);

                return true;
            }
        ));

        $hotelApplicationService->createHotel(self::NAME, self::STREET, self::POSTAL_CODE, self::BUILDING_NUMBER, self::CITY, self::COUNTRY);

    }
}
