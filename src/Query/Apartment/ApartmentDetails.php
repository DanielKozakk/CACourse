<?php


namespace App\Query\Apartment;


use App\Domain\ApartmentBookingHistory\ApartmentBookingHistory;

class ApartmentDetails
{
    private ApartmentReadModel $apartmentReadModel;
    private ApartmentBookingHistoryReadModel $apartmentBookingHistory;

    /**
     * ApartmentDetails constructor.
     * @param ApartmentReadModel $apartmentReadModel
     * @param ApartmentBookingHistoryReadModel $apartmentBookingHistory
     */
    public function __construct(ApartmentReadModel $apartmentReadModel, ApartmentBookingHistoryReadModel $apartmentBookingHistory)
    {
        $this->apartmentReadModel = $apartmentReadModel;
        $this->apartmentBookingHistory = $apartmentBookingHistory;
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
    public function getApartmentBookingHistory(): ApartmentBookingHistoryReadModel
    {
        return $this->apartmentBookingHistory;
    }

}