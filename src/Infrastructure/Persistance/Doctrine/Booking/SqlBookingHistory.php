<?php


namespace App\Infrastructure\Persistance\Doctrine\Booking;


use App\Domain\Apartment\Booking;
use App\Domain\Apartment\BookingRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SqlBookingHistory implements BookingRepository
{

    private DoctrineSqlBookingHistory $serviceEntityRepository;

    /**
     * SqlBookingHistory constructor.
     * @param ServiceEntityRepository $serviceEntityRepository
     */
    public function __construct(DoctrineSqlBookingHistory $serviceEntityRepository)
    {
        $this->serviceEntityRepository = $serviceEntityRepository;
    }


    public function save(Booking $booking)
    {
        $this->serviceEntityRepository->saveBooking($booking);
    }
}