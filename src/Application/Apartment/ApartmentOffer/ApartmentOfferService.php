<?php

namespace Application\Apartment\ApartmentOffer;

use DateTime;
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

    }
}