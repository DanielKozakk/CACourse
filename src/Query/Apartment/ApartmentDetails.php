<?php

namespace Query\Apartment;

use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
use JsonSerializable;

class ApartmentDetails implements JsonSerializable
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

    public function jsonSerialize()
    {
        $rooms = [];
        foreach($this->apartmentReadModel->getRooms() as $room){
            $rooms [] = [
                'id' =>  $room->getId(),
                'name' => $room->getName(),
                'size' => $room->getSize()
            ];
        }
        return [
            'ApartmentReadModel' => [
                'id' => $this->apartmentReadModel->getId(),
                'ownerId' => $this->apartmentReadModel->getOwnerId(),
                'street' => $this->apartmentReadModel->getStreet(),
                'postalCode' => $this->apartmentReadModel->getPostalCode(),
                'houseNumber' => $this->apartmentReadModel->getHouseNumber(),
                'apartmentNumber' => $this->apartmentReadModel->getApartmentNumber(),
                'city' => $this->apartmentReadModel->getCity(),
                'country' => $this->apartmentReadModel->getCountry(),
                'description' => $this->apartmentReadModel->getDescription(),
                'rooms' => $rooms,
            ],
        ];
    }
}