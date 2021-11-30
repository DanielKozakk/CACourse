<?php

namespace Infrastructure\Persistence\Doctrine\Apartment;

use Application\Apartment\ApartmentNotFoundException;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentAssertion;
use Domain\Apartment\ApartmentFactory;
use Domain\Apartment\ApartmentRepository;
use Helpers\PropertiesUnwrapper;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DoctrineApartmentRepositoryIntegrationTest extends WebTestCase
{

    use PropertiesUnwrapper;

    private ApartmentRepository $apartmentRepository;

    private string $ownerId = '321';
    private string $street = 'ul. Zachodnia';
    private string $postalCode = '21-201';
    private string $houseNumber = '2121';
    private string $apartmentNumber = '1';
    private string $city = 'Miasto';
    private string $country = 'Kapitalizm';
    private string $description = 'description';
    private array $roomsDefinition = ['Pokoj1' => 24.2];
    private int $apartmentId;

    /**
     * @throws ReflectionException
     */
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        self::bootKernel();
        $this->apartmentRepository = $this->getContainer()->get(ApartmentRepository::class);

        $apartment = (new ApartmentFactory())->create(
            $this->ownerId,
            $this->street,
            $this->postalCode,
            $this->houseNumber,
            $this->apartmentNumber,
            $this->city,
            $this->country,
            $this->description,
            $this->roomsDefinition);
        $this->apartmentRepository->save($apartment);

        $apartmentId = $this->getReflectionValue(Apartment::class, 'id', $apartment);
        $this->apartmentId = $apartmentId;

    }

    public function testShouldThrowExceptionWhenApartmentDoesNotExist()
    {
        $this->expectException(ApartmentNotFoundException::class);
        $this->expectExceptionMessage('Apartment with id 1234 does not exist');

        $this->apartmentRepository->findById('1234');
    }

    /**
     * @throws ReflectionException
     */
    public function testShouldReturnExistingApartment()
    {
        $fetchedApartment = $this->apartmentRepository->findById($this->apartmentId);

        ApartmentAssertion::assert($fetchedApartment)
            ->hasRoomsEqualsTo($this->roomsDefinition)
            ->hasAddressEqualsTo($this->street, $this->postalCode, $this->houseNumber, $this->apartmentNumber, $this->city, $this->country)
            ->hasOwnerIdEqualsTo($this->ownerId)
            ->hasDescriptionEqualsTo($this->description);
    }

    /**
     * @throws ReflectionException
     * @depends testShouldReturnExistingApartment
     */
    public function testShouldReturnExistingApartmentWeWant()
    {
        $firstAdditionalApartment = (new ApartmentFactory())->create(
            '21',
            'fake street',
            '24-201',
            '210921',
            '214012',
            'Fake City',
            'Fake Country',
            'Fake description',
            ['fakeRoom' => 0.1]);

        $secondAdditionalApartment = (new ApartmentFactory())->create(
            '321',
            '2fake street',
            '243-201',
            '223110921',
            '212351214012',
            'Fake City2',
            'Fake Country2',
            'Fake description2',
            ['fakeRoom2' => 0.1]);

        $thirdAdditionalApartment = (new ApartmentFactory())->create(
            '3221',
            '3fake street',
            '243213-201',
            '2212123110921',
            '2123511212214012',
            'Fake City3',
            'Fake Country3',
            'Fake description3',
            ['fakeRoom3' => 0.2]);

        $this->apartmentRepository->save($firstAdditionalApartment);
        $this->apartmentRepository->save($secondAdditionalApartment);
        $this->apartmentRepository->save($thirdAdditionalApartment);

        $fetchedApartment = $this->apartmentRepository->findById($this->apartmentId);

        ApartmentAssertion::assert($fetchedApartment)
            ->hasRoomsEqualsTo($this->roomsDefinition)
            ->hasAddressEqualsTo($this->street, $this->postalCode, $this->houseNumber, $this->apartmentNumber, $this->city, $this->country)
            ->hasOwnerIdEqualsTo($this->ownerId)
            ->hasDescriptionEqualsTo($this->description);
    }
}
