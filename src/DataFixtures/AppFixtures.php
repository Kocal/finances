<?php

namespace App\DataFixtures;

use App\Domain\Data\Model\Bank;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $bankLaBanquePostale = Bank::create('La Banque Postale');
        $manager->persist($bankLaBanquePostale);

        $manager->flush();
    }
}
