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
            //            ->andClassesThat(Selector::haveClassName('App\Application\Shared\Service\KnownBadApproach'))
            ->build();
    }
    public function testApplicationShouldTalkOnlyWithDomainAndApplication(): Rule
    {

        return $this->newRule
            ->classesThat(Selector::haveClassName('Application\*'))
            ->canOnlyDependOn()
            ->classesThat(Selector::havePath('Domain/*'))
            ->andClassesThat(Selector::haveClassName('Application\*'))
            ->andClassesThat(Selector::haveClassName('Symfony\Component\EventDispatcher\EventSubscriberInterface'))

            ->build();
    }

    public function testQueryShouldTalkOnlyWithQuery(): Rule
    {

        return $this->newRule
            ->classesThat(Selector::haveClassName('Query\*'))
            ->canOnlyDependOn()
            ->classesThat(Selector::havePath('Query/*'))
            ->andClassesThat(Selector::haveClassName('Doctrine\*'))
            ->build();
    }

    public function testInfrastructureShouldNotTalkWithDomain(): Rule
    {

        return $this->newRule
            ->classesThat(Selector::haveClassName('Infrastructure'))
            ->andExcludingClassesThat(Selector::haveClassName('Infrastructure\Persistence\*'))
            ->mustNotDependOn()
            ->classesThat(Selector::havePath('Domain/*'))
            ->build();
    }
}