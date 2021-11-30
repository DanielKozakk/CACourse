<?php

namespace Application\Apartment\ApartmentOffer;

use DataFixtures\ApartmentFixture;
use DateTime;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentAssertion;
use Domain\Apartment\ApartmentRepository;
use Domain\ApartmentOffer\ApartmentOffer;
use Domain\ApartmentOffer\ApartmentOfferAssertion;
use Domain\ApartmentOffer\ApartmentOfferRepository;
use Domain\ApartmentOffer\Money;
use Domain\ApartmentOffer\NotAllowedMoneyValueException;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class ApartmentOfferServiceTest extends WebTestCase
{
    private ApartmentOfferService $service;
    private ApartmentOfferRepository $apartmentOfferRepository;
    
    private ApartmentRepository $apartmentRepository;

    private DateTime $startDate;
    private DateTime $endDate;

    private const PRICE = 123;

    public function __construct()
    {
        parent::__construct();
        self::bootKernel();

        $this->startDate = new DateTime('2021-11-01');
        $this->endDate = new DateTime('2021-11-02');

        $this->apartmentOfferRepository = $this->createMock(ApartmentOfferRepository::class);
        $this->apartmentRepository = $this->createMock(ApartmentRepository::class);
        $this->service = new ApartmentOfferService($this->apartmentOfferRepository, $this->apartmentRepository );
    }

    /**
     * @throws NotAllowedMoneyValueException
     */
    public function testShouldRecognizePriceLowerThanAcceptable(){
        $this->givenExistingApartment();

        $price = -1;
        $this->expectErrorMessage("Price -1 is lower than zero.");
        $this->service->addOffer(ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId'], $price, $this->startDate, $this->endDate);
    }

    public function testShouldCreateApartmentOfferForExistingApartment(){
        $this->givenExistingApartment();
        $this->thenOfferShouldBeCreated($this->startDate, $this->endDate);
    }

    /**
     * @throws NotAllowedMoneyValueException
     */
    public function testShouldRecognizeApartmentDoesNotExist(){
        $this->givenNonExistingApartment();

        $apartmentId = 1205213232323;

        $this->expectErrorMessage('Apartment with id' . " $apartmentId " . 'does not exist');
        $this->service->addOffer($apartmentId, self::PRICE, $this->startDate, $this->endDate);
    }

    private function givenExistingApartment(){
        $this->apartmentRepository->method('existById')->willReturn(true);
    }

    private function givenNonExistingApartment(){
        $this->apartmentRepository->method('existById')->willReturn(false);
    }

    private function thenOfferShouldBeCreated(DateTime $start, DateTime $end){

        $this->apartmentOfferRepository->expects($this->once())->method('save')->with($this->callback(
            function (ApartmentOffer $apartmentOffer) use ( $start, $end) {

                ApartmentOfferAssertion::assert($apartmentOffer)
                    ->hasApartmentIdEqualTo(ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId'])
                    ->hasPriceEqualTo(new Money(self::PRICE))
                    ->hasStartDateEqualTo($start)
                    ->hasEndDateEqualTo($end);
                return true;
            }
        ));

        $this->service->addOffer(ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId'], self::PRICE, $start, $end);
    }
}