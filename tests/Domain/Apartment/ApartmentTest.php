<?php
declare(strict_types = 1);

namespace App\Tests\Domain\Apartment;

use App\Domain\Apartment\Apartment;
use App\Domain\Apartment\ApartmentFactory;
use PHPUnit\Framework\TestCase;

class ApartmentTest extends TestCase
{
    public function testShouldCreateApartmentWithAllRequiredFields(): void
    {
        $ownerId = '1234';
        $street = 'Florianska';
        $postalCode = '12-201';
        $houseNumber = '12';
        $apartmentNumber = '13';
        $city = 'Krakow';
        $country = 'Poland';
        $roomsDefinition = [
            "name1" => 20,
            "name2" => 16
        ];
        $description = 'Nice place to stay';

        $actual = (new ApartmentFactory())
            ->create($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country, $roomsDefinition, $ownerId, $description);

        $this->assertThatHasOwnerId($actual, $ownerId);
        $this->assertThatHasDescription($actual, $description);
        $this->assertThatHasAdress($actual, $street, $postalCode, $houseNumber, $apartmentNumber, $city, $country);
        $this->assertThatHasRooms($actual, $roomsDefinition);

    }

    private function assertThatHasOwnerId(Apartment $actual, string $ownerId)
    {

    }

    private function assertThatHasDescription(Apartment $actual, string $description)
    {
    }

    private function assertThatHasAdress(Apartment $actual, string $street, string $postalCode, string $houseNumber, string $apartmentNumber, string $city, string $country)
    {
    }

    private function assertThatHasRooms(Apartment $actual, array $roomsDefinition)
    {
    }


}
