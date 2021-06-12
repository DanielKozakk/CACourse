<?php


namespace App\Infrastructure\Persistance\Doctrine\Booking;


use App\Domain\Apartment\Booking;
use App\Domain\Apartment\BookingRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;


class SqlBookingHistory implements BookingRepository
{

    private DoctrineSqlBookingHistory $serviceEntityRepository;

    /**
     * SqlBookingHistory constructor.
     * @param DoctrineSqlBookingHistory $serviceEntityRepository
     */
    public function __construct(DoctrineSqlBookingHistory $serviceEntityRepository)
    {
        $this->serviceEntityRepository = $serviceEntityRepository;
    }


    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(Booking $booking)
    {
        $this->serviceEntityRepository->saveBooking($booking);
    }

    public function findById(string $getBookingId): ?Booking
    {
        return $this->serviceEntityRepository->find($getBookingId);
    }


}