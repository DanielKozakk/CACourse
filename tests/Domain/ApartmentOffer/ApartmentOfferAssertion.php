<?php

namespace Domain\ApartmentOffer;

use DateTime;
use Helpers\PropertiesUnwrapper;
use PHPUnit\Framework\Assert;
use ReflectionException;

class ApartmentOfferAssertion extends Assert
{
    use PropertiesUnwrapper;
    private ApartmentOffer $apartmentOffer;


    /**
     * @param ApartmentOffer $apartmentOffer
     */
    private function __construct(ApartmentOffer $apartmentOffer){
        $this->apartmentOffer = $apartmentOffer;
    }


    public static function assert(ApartmentOffer $apartmentOffer): ApartmentOfferAssertion
    {
        return new ApartmentOfferAssertion($apartmentOffer);
    }

    /**
     * @throws ReflectionException
     */
    public function hasApartmentIdEqualTo(int $apartmentId) : ApartmentOfferAssertion
    {
        $actual = $this->getReflectionValue(ApartmentOffer::class, 'apartmentId', $this->apartmentOffer);
        $this->assertSame($actual, $apartmentId);
        return $this;
    }

    /**
     * @param Money $price
     * @return ApartmentOfferAssertion
     * @throws ReflectionException
     */
    public function hasPriceEqualTo(Money $price) : ApartmentOfferAssertion
    {
        $actual = $this->getReflectionValue(ApartmentOffer::class, 'price', $this->apartmentOffer);
        $this->assertEquals($actual, $price);

        return $this;

    }

    /**
     * @throws ReflectionException
     */
    public function hasStartDateEqualTo(DateTime $start) : ApartmentOfferAssertion
    {
        $availability = $this->getReflectionValue(ApartmentOffer::class, 'availability', $this->apartmentOffer);
        $actual = $this->getReflectionValue(ApartmentAvailability::class, 'start', $availability);

        $this->assertSame($actual, $start);
        return $this;

    }

    /**
     * @throws ReflectionException
     */
    public function hasEndDateEqualTo(DateTime $end) : ApartmentOfferAssertion
    {
        $availability = $this->getReflectionValue(ApartmentOffer::class, 'availability', $this->apartmentOffer);
        $actual = $this->getReflectionValue(ApartmentAvailability::class, 'end', $availability);
        $this->assertSame($actual, $end);
        return $this;
    }

}