<?php
//
//namespace Domain\Hotel\HotelRoom;
//use Doctrine\ORM\Mapping as ORM;
//
///**
// * @ ORM\Entity
// */
//class Space
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
//    private string $name;
//
//    /**
//     * @var SquareMeter
//     * @ORM\Embedded(class="SquareMeter")
//     */
//    private SquareMeter $squareMeter;
//
//    /**
//     * @var HotelRoom
//     * @ORM\ManyToOne(targetEntity="HotelRoom", inversedBy="spaces")
//     */
//    private HotelRoom $hotelRoom;
//
//    public function __construct(string $name, SquareMeter $squareMeter)
//    {
//        $this->name = $name;
//        $this->squareMeter = $squareMeter;
//    }
//}