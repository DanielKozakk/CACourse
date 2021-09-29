<?php
//
//namespace Query\Hotel;
//
//use Doctrine\ORM\Mapping as ORM;
//
//class HotelReadModel
//{
//    /**
//     * @ORM\Id
//     * @ORM\GeneratedValue
//     * @ORM\Column(type="integer")
//     */
//    private $id;
//
//    /**
//     * @var string
//     * @ORM\Column(type="string", length=255)
//     */
//    private $name;
//    /**
//     * @var string
//     * @ORM\Column(type="string", length=255)
//     */
//    private $street;
//    /**
//     * @var string
//     * @ORM\Column(type="string", length=255)
//     */
//    private $buildingNumber;
//    /**
//     * @var string
//     * @ORM\Column(type="string", length=255)
//     */
//    private $postalCode;
//    /**
//     * @var string
//     * @ORM\Column(type="string", length=255)
//     */
//    private $city;
//    /**
//     * @var string
//     * @ORM\Column(type="string", length=255)
//     */
//    private $country;
//
//    /**
//     * @param string $name
//     * @param string $street
//     * @param string $buildingNumber
//     * @param string $postalCode
//     * @param string $city
//     * @param string $country
//     */
//    public function __construct(string $name, string $street, string $buildingNumber, string $postalCode, string $city, string $country)
//    {
//        $this->name = $name;
//        $this->street = $street;
//        $this->buildingNumber = $buildingNumber;
//        $this->postalCode = $postalCode;
//        $this->city = $city;
//        $this->country = $country;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * @return string
//     */
//    public function getName(): string
//    {
//        return $this->name;
//    }
//
//    /**
//     * @return string
//     */
//    public function getStreet(): string
//    {
//        return $this->street;
//    }
//
//    /**
//     * @return string
//     */
//    public function getBuildingNumber(): string
//    {
//        return $this->buildingNumber;
//    }
//
//    /**
//     * @return string
//     */
//    public function getPostalCode(): string
//    {
//        return $this->postalCode;
//    }
//
//    /**
//     * @return string
//     */
//    public function getCity(): string
//    {
//        return $this->city;
//    }
//
//    /**
//     * @return string
//     */
//    public function getCountry(): string
//    {
//        return $this->country;
//    }
//
//
//
//
//}