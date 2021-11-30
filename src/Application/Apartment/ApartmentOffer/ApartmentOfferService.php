<?php

namespace Application\Apartment\ApartmentOffer;

use Application\Apartment\ApartmentNotFoundException;
use DateTime;

use Domain\Apartment\ApartmentRepository;
use Domain\ApartmentOffer\ApartmentAvailability;
use Domain\ApartmentOffer\ApartmentOffer;
use Domain\ApartmentOffer\ApartmentOfferRepository;
use Domain\ApartmentOffer\Money;

class ApartmentOfferService
{
    private ApartmentOfferRepository $apartmentOfferRepository;
    private ApartmentRepository $apartmentRepository;

    /**
     * @param ApartmentOfferRepository $apartmentOfferRepository
     * @param ApartmentRepository $apartmentRepository
     */
    public function __construct(ApartmentOfferRepository $apartmentOfferRepository, ApartmentRepository $apartmentRepository)
    {
        $this->apartmentOfferRepository = $apartmentOfferRepository;
        $this->apartmentRepository = $apartmentRepository;
    }


    public function addOffer(int $apartmentId, int $price, DateTime $start, DateTime $end){

        if(!$this->apartmentRepository->existById($apartmentId)){
            throw new ApartmentNotFoundException('Apartment with id' . " $apartmentId " . 'does not exist');
        }
        $offer = new ApartmentOffer($apartmentId, new Money($price), new ApartmentAvailability($start, $end));

        $this->apartmentOfferRepository->save($offer);

    }
}