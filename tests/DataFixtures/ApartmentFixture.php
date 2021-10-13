<?php

namespace DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Domain\Hotel\HotelRoom\Space;
use Query\Apartment\ApartmentReadModel;
use Query\Hotel\HotelRoom\SpaceReadModel;

class ApartmentFixture extends Fixture implements ORMFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $arm = new ApartmentReadModel(234,'214', 'Krakowska','12-2','421','1p2','124','Krakowia', '125123');

        // $product = new Product();
        // $manager->persist($product);
         $manager->persist($arm);

        $manager->flush();
    }
}
