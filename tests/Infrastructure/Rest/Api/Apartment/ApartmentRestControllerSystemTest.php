<?php

namespace Infrastructure\Rest\Api\Apartment;

use DataFixtures\ApartmentFixture;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

class ApartmentRestControllerSystemTest extends WebTestCase
{

    private ApartmentRestController $apartmentRestController;

    private const FIND_APARTMENT_URL = 'api/apartment/find/';
    private const CREATE_APARTMENT_URL = '/api/apartment/add';
    private const GET = 'GET';

    public function __construct()
    {
        parent::__construct();
        self::bootKernel();

        $this->apartmentRestController = $this->getContainer()->get(ApartmentRestController::class);
    }

    public function testShouldReturnNothingWhenApartmentDoesNotExist()
    {

        $client = self::createClient();
        $randomId = uniqid();
        $client->request(self::GET, self::FIND_APARTMENT_URL . $randomId);


        $this->assertResponseIsSuccessful();

        $this->assertSame($client->getResponse()->getContent(), 'null');
    }

    public function testShouldReturnExistingApartment()
    {
        $id = ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId'];
        $client = self::createClient();
        $client->request(self::GET, self::FIND_APARTMENT_URL . $id);


        $response = json_decode($client->getResponse()->getContent(), true);
        $returnedApartmentReadModel = $response['ApartmentReadModel'];


        $this->assertSame($returnedApartmentReadModel['id'], ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId']);

        $this->assertResponseIsSuccessful();
    }

    public function testShouldCreateNewApartment()
    {
        $client = self::createClient();

        $parameters = [
            'ownerId' => '1234',
            'street' => 'Miałczewska',
            'postalCode' => '21-211',
            'houseNumber' => '2119999',
            'apartmentNumber' => '2112',
            'city' => '5123',
            'country' => 'Polska',
            'description' => 'Opis',
            'roomsDefinition' => ['przykladowy_pokoj' => 20]
        ];

        $client->request('POST', self::CREATE_APARTMENT_URL, ['ApartmentCreationDto' => $parameters]);

        $this->assertResponseStatusCodeSame(201);
    }
}
