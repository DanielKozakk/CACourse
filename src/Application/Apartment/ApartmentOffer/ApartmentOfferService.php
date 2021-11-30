<?php

namespace Application\Apartment\ApartmentOffer;

use DateTime;
use Domain\Apartment\ApartmentOffer\ApartmentAvailability;
use Domain\Apartment\ApartmentOffer\Money;
use Domain\Apartment\ApartmentOffer\Offer;
use Domain\ApartmentOffer\ApartmentOfferRepository;

class ApartmentOfferService
{
    private ApartmentOfferRepository $apartmentOfferRepository;

    /**
     * @param ApartmentOfferRepository $apartmentOfferRepository
     */
    public function __construct(ApartmentOfferRepository $apartmentOfferRepository)
    {
        $this->apartmentOfferRepository = $apartmentOfferRepository;
    }

    public function addOffer(int $apartmentId, int $price, DateTime $start, DateTime $end){
        $offer = new Offer($apartmentId, new Money($price), new ApartmentAvailability($start, $end));
        $this->apartmentOfferRepository->save($offer);

    }
}