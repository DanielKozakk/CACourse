<?php

namespace Domain\Apartment;

use PHPUnit\Framework\TestCase;
use ReflectionProperty;

class ApartmentTest extends TestCase
{

    const ownerId = '1234';
    const street = 'Florianska';
    const postalCode = '12-201';
    const houseNumber = '12';
    const apartmentNumber = '13';
    const city = 'Krakow';
    const country = 'Poland';
    const description = 'Nice place to stay';
    const roomsDefinition = [
        "name1" => 20.0,
        "name2" => 16.0
    ];

    private ApartmentFactory $apartmentFactory;

    public function __construct()
    {
        parent::__construct();
        $this->apartmentFactory = new ApartmentFactory();
    }
    
    public function testShouldCreateApartmentWithAllInformation()
    {

        $actualApartment = $this->apartmentFactory->create(self::ownerId, self::street, self::postalCode, self::houseNumber, self::apartmentNumber, self::city, self::country, self::description, self::roomsDefinition);

        ApartmentAssertion::assert($actualApartment)
        ->hasOwnerIdEqualsTo( self::ownerId)
        ->hasDescriptionEqualsTo( self::description)
        ->hasAddressEqualsTo( self::street, self::postalCode, self::houseNumber, self::apartmentNumber, self::city, self::country)
        ->hasRoomsEqualsTo( self::roomsDefinition);

    }
}
