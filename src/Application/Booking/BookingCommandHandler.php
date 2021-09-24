<?php
//
//namespace Application\Booking;
//
//use Application\CommandChannel\CommandChannel;
//use Domain\Apartment\Booking;
//use Domain\Apartment\BookingRepository;
//use Domain\EventChannel\EventChannel;
//use Symfony\Component\EventDispatcher\EventSubscriberInterface;
//
//class BookingCommandHandler implements EventSubscriberInterface
//{
//
//    /**
//     * @var BookingRepository
//     */
//    private BookingRepository $bookingRepository;
//
//    private EventChannel $eventChannel;
//
//
//    /**
//     * BookingCommandHandler constructor.
//     * @param BookingRepository $bookingRepository
//     */
//    public function __construct(BookingRepository $bookingRepository, EventChannel $eventChannel)
//    {
//        $this->bookingRepository = $bookingRepository;
//        $this->eventChannel = $eventChannel;
//    }
//
//    public static function getSubscribedEvents()
//    {
//        return [
//            RejectBookingCommand::class => [
//                ['onBookingRejectCommand', 10]
//            ],
//            AcceptBookingCommand::class => [
//                ['onBookingAcceptCommand', 10]
//            ]
//        ];
//    }
//
//    public function onBookingRejectCommand(RejectBookingCommand $bookingRejectCommand)
//    {
//        /** @var Booking */
//        $booking = $this->bookingRepository->findById($bookingRejectCommand->getBookingId());
//
//        $booking->reject();
//
//        $this->bookingRepository->save($booking);
//    }
//
//    public function onBookingAcceptCommand(AcceptBookingCommand $bookingAcceptCommand)
//    {
//        $booking = $this->bookingRepository->findById($bookingAcceptCommand->getId());
//        $booking->accept($this->eventChannel);
//
//        $this->bookingRepository->save($booking);
//    }
//}