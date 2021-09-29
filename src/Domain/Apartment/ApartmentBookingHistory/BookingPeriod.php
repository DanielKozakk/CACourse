<?php
//
//namespace Domain\Apartment\ApartmentBookingHistory;
//
//use DateTime;
//use Doctrine\ORM\Mapping as ORM;
//
///**
// * @ORM\Embeddable
// */
//class BookingPeriod
//{
//    /**
//     * @var DateTime
//     * @ORM\Column(type="datetime")
//     */
//    private DateTime $startDate;
//
//    /**
//     * @var DateTime
//     * @ORM\Column(type="datetime")
//     */
//    private DateTime $endDate;
//
//    /**
//     * @param DateTime $startDate
//     * @param DateTime $endDate
//     */
//    public function __construct(DateTime $startDate, DateTime $endDate)
//    {
//        $this->startDate = $startDate;
//        $this->endDate = $endDate;
//    }
//
//}