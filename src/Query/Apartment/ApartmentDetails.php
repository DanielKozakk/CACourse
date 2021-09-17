<?php

namespace Query\Apartment;

use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;

class ApartmentDetails
{

    private ApartmentReadModel $apartmentReadModel;
    private ApartmentBookingHistoryReadModel $apartmentBookingHistoryReadModel;

    /**
     * @param ApartmentReadModel $apartmentReadModel
     * @param ApartmentBookingHistoryReadModel $apartmentBookingHistoryReadModel
     */
    public function __construct(ApartmentReadModel $apartmentReadModel, ApartmentBookingHistoryReadModel $apartmentBookingHistoryReadModel)
    {
        $this->apartmentReadModel = $apartmentReadModel;
        $this->apartmentBookingHistoryReadModel = $apartmentBookingHistoryReadModel;
    }

    /**
     * @return ApartmentReadModel
     */
    public function getApartmentReadModel(): ApartmentReadModel
    {
        return $this->apartmentReadModel;
    }

    /**
     * @return ApartmentBookingHistoryReadModel
     */
    public function getApartmentBookingHistoryReadModel(): ApartmentBookingHistoryReadModel
    {
        return $this->apartmentBookingHistoryReadModel;
    }

}