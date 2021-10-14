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
    public function load(ObjectManager $manager)
    {

        $ownerId= '214';
        $street= 'Krakowska';
        $postalCode= '124-53';
        $houseNumber= '421';
        $apartmentNumber= '24';
        $city= 'Warszawa';
        $country= 'Polska';
        $description = 'To jest pewien opis.';
        $roomsDefinition = ['Kuchnia' => 24.5, 'Salon' => 50, 'Łazienka' => 10];

        $apartment = (new ApartmentFactory())->create($ownerId, $street, $postalCode, $houseNumber, $apartmentNumber, $city, $country, $description, $roomsDefinition );


        $apartmentReadModel = new ApartmentReadModel(1,$ownerId, $street,$postalCode,$houseNumber,$apartmentNumber,$city,$country, $description);

        // $product = new Product();
        // $manager->persist($product);
         $manager->persist($apartmentReadModel);
         $manager->persist($apartment);

        $manager->flush();
    }
}
