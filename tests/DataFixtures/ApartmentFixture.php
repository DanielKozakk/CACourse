<?php

namespace DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Domain\Apartment\ApartmentFactory;
use Domain\Hotel\HotelRoom\Space;
use Query\Apartment\ApartmentReadModel;
use Query\Hotel\HotelRoom\SpaceReadModel;

class ApartmentFixture extends Fixture implements ORMFixtureInterface
{
    public const FIRST_TEST_APARTMENT_FIST_SPACE_NAME = "Kuchnia";
    public const FIRST_TEST_APARTMENT_SECOND_SPACE_NAME = "Salon";
    public const FIRST_TEST_APARTMENT_THIRD_SPACE_NAME = "Łazienka";

    public const FIRST_TEST_APARTMENT = [
        'apartmentId' => 1,
        'ownerId' => '124',
        'street' => 'Krakowska',
        'postalCode' => '124-53',
        'houseNumber' => '421',
        'apartmentNumber' => '24',
        'city' => 'Warszawa',
        'country' => 'Polska',
        'description' => 'To jest pewien opis.',
        'roomsDefinition' =>  [self::FIRST_TEST_APARTMENT_FIST_SPACE_NAME => 24.5, self::FIRST_TEST_APARTMENT_SECOND_SPACE_NAME => 50.0, self::FIRST_TEST_APARTMENT_THIRD_SPACE_NAME => 10.0],
    ];

    public function load(ObjectManager $manager)
    {
        $apartment = (new ApartmentFactory())->create(
            self::FIRST_TEST_APARTMENT['ownerId'],
            self::FIRST_TEST_APARTMENT['street'],
            self::FIRST_TEST_APARTMENT['postalCode'],
            self::FIRST_TEST_APARTMENT['houseNumber'],
            self::FIRST_TEST_APARTMENT['apartmentNumber'],
            self::FIRST_TEST_APARTMENT['city'],
            self::FIRST_TEST_APARTMENT['country'],
            self::FIRST_TEST_APARTMENT['description'],
            self::FIRST_TEST_APARTMENT['roomsDefinition'],

        );

        $apartmentReadModel = new ApartmentReadModel(
            self::FIRST_TEST_APARTMENT['apartmentId'],
            self::FIRST_TEST_APARTMENT['ownerId'],
            self::FIRST_TEST_APARTMENT['street'],
            self::FIRST_TEST_APARTMENT['postalCode'],
            self::FIRST_TEST_APARTMENT['houseNumber'],
            self::FIRST_TEST_APARTMENT['apartmentNumber'],
            self::FIRST_TEST_APARTMENT['city'],
            self::FIRST_TEST_APARTMENT['country'],
            self::FIRST_TEST_APARTMENT['description'],

        );
         $manager->persist($apartmentReadModel);
         $manager->persist($apartment);

        $manager->flush();
    }
}
