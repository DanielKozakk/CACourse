<?php

namespace Domain\ApartmentOffer;

interface ApartmentOfferRepository
{

    public function save(ApartmentOffer $apartmentOffer);
}