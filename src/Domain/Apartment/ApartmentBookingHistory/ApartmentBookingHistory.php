<?php
//
//namespace Domain\Apartment\ApartmentBookingHistory;
//
//use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\ORM\Mapping as ORM;
//
///**
// * @ ORM\Entity(repositoryClass="\Infrastructure\Persistence\Doctrine\Apartment\ApartmentBookingHistory\SqlDoctrineApartmentBookingHistory")
// */
//class ApartmentBookingHistory
//{
//
//    /**
//     * @ORM\Id
//     * @ORM\GeneratedValue
//     * @ORM\Column(type="int)
//     */
//    private int $id;
//
//    /**
//     * @ORM\OneToOne(targetEntity="Apartment")
//     * @ORM\JoinColumn(name="id", referencedColumnName="id")
//     *
//     */
//    private string $apartmentId;
//
//    /**
//     *
//     * @var array<ApartmentBooking>|ArrayCollection
//     * @ORM\OneToMany(targetEntity="ApartmentBooking")
//     */
//    private array|ArrayCollection $apartmentBookingList;
//
//    /**
//     * @param string $apartmentId
//     */
//    public function __construct(string $apartmentId){
//        $this->apartmentId = $apartmentId;
//        $this->apartmentBookingList = new ArrayCollection();
//    }
//
//
//    public function add(ApartmentBooking $apartmentBooking){
//        array_push($this->apartmentBookingList, $apartmentBooking);
//    }
//
//}