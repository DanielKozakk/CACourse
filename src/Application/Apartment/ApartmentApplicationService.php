<?php


namespace App\Application\Apartment;

use App\Domain\Apartment\ApartamentFactory;
use App\Domain\Apartment\ApartmentRepository;


class ApartmentApplicationService
{

    /**
     * @var ApartmentRepository
     */
    private $apartmentRepository;

    /**
     * ApartmentApplicationService constructor.
     * @param ApartmentRepository $apartmentRepository
     */
    public function __construct(ApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
    }


    public function add(
        string $ownerId,
        String $street,
        string $postalCode,
        string $houseNumber,
        string $apartmentNumber,
        string $city,
        string $country,
        string $description,
        array $roomsDefinition
    ) : void{
        $apartment = (new ApartamentFactory())->create($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country, $roomsDefinition, $ownerId, $description);

        $this->apartmentRepository->save($apartment);
    }




}