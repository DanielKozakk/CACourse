<?php

namespace Application\Apartment\ApartmentOffer;

use DataFixtures\ApartmentFixture;
use DateTime;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentAssertion;
use Domain\ApartmentOffer\ApartmentOffer;
use Domain\ApartmentOffer\ApartmentOfferAssertion;
use Domain\ApartmentOffer\ApartmentOfferRepository;
use PHPUnit\Framework\TestCase;


class ApartmentOfferServiceTest extends TestCase
{
    private ApartmentOfferService $service;
    private ApartmentOfferRepository $repository;


    public function __construct()
    {
        parent::__construct();
        $this->repository = $this->createMock(ApartmentOfferRepository::class);
        $this->service = new ApartmentOfferService($this->repository);
    }


    public function testShouldCreateApartmentOffer(){

        $price = 123;
        $start = new DateTime('2021-11-01');
        $end = new DateTime('2021-11-02');

        $this->thenOfferShouldBeCreated($price, $start, $end);
    }

    private function thenOfferShouldBeCreated(int $price, DateTime $start, DateTime $end){

        $this->repository->expects($this->once())->method('save')->with($this->callback(
            function (ApartmentOffer $apartmentOffer) use ($price, $start, $end) {

                ApartmentOfferAssertion::assert($apartmentOffer)
                    ->hasApartmentIdEqualTo(ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId'])
                    ->hasPriceEqualTo($price)
                    ->hasStartDateEqualTo($start)
                    ->hasEndDateEqualTo($end);
                return true;
            }
        ));

        $this->service->addOffer(ApartmentFixture::FIRST_TEST_APARTMENT['apartmentId'], $price, $start, $end);
    }
}