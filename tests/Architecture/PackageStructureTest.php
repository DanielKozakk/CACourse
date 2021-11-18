<?php

namespace Architecture;

use PhpAT\Rule\Rule;
use PhpAT\Selector\Selector;
use PhpAT\Test\ArchitectureTest;

class PackageStructureTest extends ArchitectureTest
{

    public function testDomainShouldTalkOnlyWithDomain(): Rule
    {

        return $this->newRule
            ->classesThat(Selector::haveClassName('Domain\*'))
//            ->excludingClassesThat(Selector::implementInterface(BlackMagicInterface::class))
            ->canOnlyDependOn()
            ->classesThat(Selector::havePath('Domain/*'))
            ->andClassesThat(Selector::haveClassName('Doctrine\Common\Collections\ArrayCollection'))
            ->andClassesThat(Selector::haveClassName('Doctrine\ORM\PersistentCollection'))
//            ->andClassesThat(Selector::haveClassName('Infrastructure\Persistence\Doctrine\Hotel\DoctrineHotelRepository'))
            //            ->andClassesThat(Selector::haveClassName('App\Application\Shared\Service\KnownBadApproach'))
            ->build();
    }

}