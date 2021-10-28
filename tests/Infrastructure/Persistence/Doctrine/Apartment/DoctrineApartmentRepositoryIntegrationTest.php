<?php

namespace Infrastructure\Persistence\Doctrine\Apartment;

use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentAssertion;
use Domain\Apartment\ApartmentFactory;
use Domain\Apartment\ApartmentRepository;
use Helpers\PropertiesUnwrapper;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DoctrineApartmentRepositoryIntegrationTest extends WebTestCase
{

    use PropertiesUnwrapper;
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

    /**
     * @throws \ReflectionException
     */
    public function testShouldReturnExistingApartment(){

        $ownerId = '321';
        $street = 'ul. Zachodnia';
        $postalCode = '21-201';
        $houseNumber = '2121';
        $apartmentNumber = '1';
        $city = 'Miasto';
        $country = 'Kapitalizm';
        $description = 'description';
        $roomsDefinition = ['Pokoj1' => 24.2];

        $apartment = (new ApartmentFactory())->create(
            $ownerId,
            $street,
            $postalCode,
            $houseNumber,
            $apartmentNumber,
            $city,
            $country,
            $description,
            $roomsDefinition);
        $this->apartmentRepository->save($apartment);

        $fetchedApartment = $this->apartmentRepository->findById($this->getReflectionValue(Apartment::class, 'id', $apartment));

        ApartmentAssertion::assert($fetchedApartment)
            ->hasRoomsEqualsTo($roomsDefinition)
            ->hasAddressEqualsTo($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country)
            ->hasOwnerIdEqualsTo($ownerId)
            ->hasDescriptionEqualsTo($description);
    }

}
