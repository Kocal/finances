<?php

declare(strict_types=1);

namespace App\Application\Model\DataFixtures;

use App\Application\Model\Factory\BankFactory;
use App\Domain\Data\ValueObject\BankId;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class BankFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        BankFactory::createSequence([
            [
                'id' => BankId::LA_BANQUE_POSTALE,
            ],
            [
                'id' => BankId::BNP_PARIBAS,
            ],
            [
                'id' => BankId::CREDIT_AGRICOLE,
            ],
            [
                'id' => BankId::SOCIETE_GENERALE,
            ],
            [
                'id' => BankId::CIC,
            ],
            [
                'id' => BankId::CREDIT_MUTUEL,
            ],
            [
                'id' => BankId::BANQUE_POPULAIRE,
            ],
            [
                'id' => BankId::CAISSE_EPARGNE,
            ],
            [
                'id' => BankId::CREDIT_FONCIER,
            ],
        ]);
    }
}
