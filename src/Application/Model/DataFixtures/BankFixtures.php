<?php
declare(strict_types=1);

namespace App\Application\Model\DataFixtures;

use App\Application\Model\Factory\BankFactory;
use App\Domain\Data\ValueObject\BankId;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class BankFixtures extends Fixture
{
    public const LA_BANQUE_POSTALE = '01939be8-e0f3-70ee-bb08-4373a8257fb2';
    public const BNP_PARIBAS = '01939be8-e0f3-7372-817b-45e160c8a481';
    public const CREDIT_AGRICOLE = '01939be8-e0f3-7c2b-9f1a-450dc643cbe3';
    public const SOCIETE_GENERALE = '01939be8-e0f3-79bd-b813-3a8f3e2b26f9';
    public const CIC = '01939be8-e0f3-7b1d-b150-b5ca0e6aaa7d';
    public const CREDIT_MUTUEL = '01939be8-e0f3-7737-b91f-4b35e8f2f912';
    public const BANQUE_POPULAIRE = '01939be8-e0f3-7025-b6b3-1ddf5b7beca2';
    public const CAISSE_EPARGNE = '01939be8-e0f3-715d-833d-cd4c4a0d0ec3';
    public const CREDIT_FONCIER = '01939be8-e0f4-7269-9c49-6dc1fff1f7fe';

    public function load(ObjectManager $manager): void
    {
        BankFactory::createSequence([
            ['id' => BankId::fromString(self::LA_BANQUE_POSTALE)],
            ['id' => BankId::fromString(self::BNP_PARIBAS)],
            ['id' => BankId::fromString(self::CREDIT_AGRICOLE)],
            ['id' => BankId::fromString(self::SOCIETE_GENERALE)],
            ['id' => BankId::fromString(self::CIC)],
            ['id' => BankId::fromString(self::CREDIT_MUTUEL)],
            ['id' => BankId::fromString(self::BANQUE_POPULAIRE)],
            ['id' => BankId::fromString(self::CAISSE_EPARGNE)],
            ['id' => BankId::fromString(self::CREDIT_FONCIER)],
        ]);
    }
}
