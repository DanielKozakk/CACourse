<?php


namespace App\Domain\HotelRoom;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class SquareMeter
 * @package App\Domain\HotelRoom
 * @ORM\Embeddable
 */
class SquareMeter
{

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $size;

    /**
     * SquareMeter constructor.
     * @param float $size
     */
    public function __construct(float $size)
    {
        $this->size = $size;
    }

}