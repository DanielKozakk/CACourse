<?php

namespace Domain\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Domain\Hotel\Hotel;
use Domain\Hotel\HotelAddress;
use Domain\Hotel\HotelBookingHistory\HotelBookingHistory;
use Domain\Hotel\HotelRoom\HotelRoom;
use Domain\Hotel\HotelRoom\Space;
use Domain\Hotel\HotelRoom\SquareMeter;
use Query\Apartment\ApartmentReadModel;
use Query\Hotel\HotelRoom\SpaceReadModel;

class HotelFixture extends Fixture implements ORMFixtureInterface
{
    public function load(ObjectManager $manager)
    {

//        $arm = new ApartmentReadModel(234,'214', 'Krakowska','12-2','421','1p2','124','Krakowia', '125123');

        // $product = new Product();
        // $manager->persist($product);
//         $manager->persist($arm);

//        $

        $hotelAddress = new HotelAddress('ul. Testowa', '12', '39-120', 'Sędziszów Małopolski','Polska');
        $hotel = new Hotel('Pierwszy testowy hotel', $hotelAddress);

        $manager->persist($hotel);


        $hotelRoom = new HotelRoom($hotel, '142', 'Opis testowego pokoju hotelowego');

        Space::assignNewSpaceToHotelRoom('Testowa kuchnia', 24.5, $hotelRoom);
        Space::assignNewSpaceToHotelRoom('Testowy salon', 50, $hotelRoom);

        $manager->persist($hotelRoom);


        $manager->flush();
    }
}
