<?php

namespace Application\Apartment\ApartmentOffer;

use Application\Apartment\ApartmentNotFoundException;
use DateTime;

use Domain\Apartment\ApartmentRepository;
use Domain\ApartmentOffer\ApartmentAvailability;
use Domain\ApartmentOffer\ApartmentOffer;
use Domain\ApartmentOffer\ApartmentOfferRepository;
use Domain\ApartmentOffer\Money;
use Domain\ApartmentOffer\NotAllowedMoneyValueException;

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


    /**
     * @throws NotAllowedMoneyValueException
     */
    public function addOffer(int $apartmentId, int $price, DateTime $start, DateTime $end){

        if(!$this->apartmentRepository->existById($apartmentId)){
            throw new ApartmentNotFoundException('Apartment with id' . " $apartmentId " . 'does not exist');
        }
        if($price < 0){
            throw new NotAllowedMoneyValueException($price);
        }
        $offer = new ApartmentOffer($apartmentId, new Money($price), new ApartmentAvailability($start, $end));

        $this->apartmentOfferRepository->save($offer);

    }
}