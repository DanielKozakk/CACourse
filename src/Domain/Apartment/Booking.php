<?php


namespace App\Domain\Apartment;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Booking
 * @package App\Domain\Apartment
 * @ORM\Entity
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    private string $id;

    /**
     * @var string
     * @ORM\Column(name="string")
     */
    private string $apartmentId;
    /**
     * @var string
     * @ORM\Column(name="string")
     */
    private string $tenantId;

    /**
     * @ORM\Embeddable(class="Period")
     */
    private Period $period;

    /**
     * Booking constructor.
     * @param string $id
     * @param string $tenantId
     * @param Period $period
     */
    public function __construct(string $id, string $tenantId, Period $period)
    {
        $this->apartmentId = $id;
        $this->tenantId = $tenantId;
        $this->period = $period;
    }

}