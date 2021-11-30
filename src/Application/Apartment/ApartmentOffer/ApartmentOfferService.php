<?php

namespace Application\Apartment\ApartmentOffer;

use DateTime;

use Domain\ApartmentOffer\ApartmentAvailability;
use Domain\ApartmentOffer\ApartmentOffer;
use Domain\ApartmentOffer\ApartmentOfferRepository;
use Domain\ApartmentOffer\Money;

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
        $offer = new ApartmentOffer($apartmentId, new Money($price), new ApartmentAvailability($start, $end));
        $this->apartmentOfferRepository->save($offer);

    }
}