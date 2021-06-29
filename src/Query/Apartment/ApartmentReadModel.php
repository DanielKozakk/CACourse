<?php


namespace App\Query\Apartment;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * Class Apartment
 * @package App\Domain\Apartment
 *
 * TODO: zmień repository prawdopodobnie będzie to potrzebne
 * @ Entity(repositoryClass="AApp\Query\Apartment\QueryApartmentRepository")
 */
class ApartmentReadModel{

    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var string
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $ownerId;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var string
     */
    private $street;
    /**
     * @var string
     */
    private $postalCode;
    /**
     * @var string
     */
    private $houseNumber;
    /**
     * @var string
     */
    private $apartmentNumber;
    /**
     * @var string
     */
    private $city;
    /**
     * @var string
     */
    private $country;



}