<?php

namespace Application\Apartment\ApartmentBookingHistory;

use Domain\Apartment\ApartmentBookedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ApartmentBookingHistoryEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            ApartmentBookedEvent::class => [
                ['book', 10]
            ],
        ];
    }

    public function book(ExceptionEvent $event)
    {
    }

}