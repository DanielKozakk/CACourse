<?php

namespace Application\Apartment\ApartmentBookingHistory;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApartmentBookingHistoryEventSubscriberTest extends WebTestCase
{
    private ApartmentBookingHistoryEventSubscriber $eventListener;


    public function __construct()
    {
        parent::__construct();
        self::bootKernel();
        $this->eventListener = $this->getContainer()->get(ApartmentBookingHistoryEventSubscriber::class);
    }

    public function testShould(){
        self::assertTrue(true);
    }
}
