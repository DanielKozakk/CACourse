<?php
//
//namespace Domain\Apartment\ApartmentBookingHistory;
//
//use Doctrine\ORM\Mapping as ORM;
//
///**
// * @ORM\Embeddable
// */
//class BookingStep
//{
//    private const STATES = [self::START];
//
//    public const START = 'START';
//
//    /**
//     * @var string
//     */
//    private string $state;
//
//    /**
//     * BookingStep constructor.
//     * @param string $state
//     */
//    private function __construct(string $state)
//    {
//            $this->state = $state;
//    }
//
//    public static function start():BookingStep {
//        return new BookingStep(self::START);
//    }
//
//    /**
//     * @return string
//     */
//    public function getState(): string
//    {
//        return $this->state;
//    }
//
//}