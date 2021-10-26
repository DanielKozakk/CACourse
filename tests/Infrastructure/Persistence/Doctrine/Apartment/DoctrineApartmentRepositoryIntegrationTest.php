<?php

namespace Infrastructure\Persistence\Doctrine\Apartment;

use Domain\Apartment\ApartmentRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DoctrineApartmentRepositoryIntegrationTest extends WebTestCase
{

    private ApartmentRepository $apartmentRepository;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        self::bootKernel();
        $this->apartmentRepository = $this->getContainer()->get(ApartmentRepository::class);
    }

    public function testShouldThrowExceptionWhenApartmentDoesNotExist(){

        $this->expectException(ApartmentNotFoundException::class);
        $this->expectExceptionMessage('Apartment with id 1234 does not exist');

        $this->apartmentRepository->findById('1234');
    }

}
