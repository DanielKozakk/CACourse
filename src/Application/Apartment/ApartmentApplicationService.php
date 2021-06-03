<?php


namespace App\Application\Apartment;

use App\Domain\Apartment\ApartamentFactory;
use App\Domain\Apartment\Apartment;
use App\Domain\Apartment\ApartmentRepository;
use App\Domain\Apartment\Period;


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

    public function book(string $id, string $tenantId, \DateTime $start, \DateTime $end)
    {
        $apartment = $this->apartmentRepository->findById($id);

        /**
         * @var Period
         */
        $period = new Period($start, $end);

        /**
         * @var Apartment
         */

        $apartment->book($tenantId, $period);

    }

}