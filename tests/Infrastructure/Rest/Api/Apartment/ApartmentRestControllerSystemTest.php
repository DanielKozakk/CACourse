<?php

namespace Infrastructure\Rest\Api\Apartment;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApartmentRestControllerSystemTest extends WebTestCase
{

    private ApartmentRestController $apartmentRestController;

    public function __construct()
    {
        parent::__construct();
        self::bootKernel();

        $this->apartmentRestController = $this->getContainer()->get(ApartmentRestController::class);
    }



}
