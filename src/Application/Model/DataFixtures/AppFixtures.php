<?php

namespace App\Application\Model\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            BankFixtures::class,
            BankAccountFixtures::class,
        ];
    }
}
