<?php
declare(strict_types=1);

namespace App\Application\Model\DataFixtures;

use App\Application\Model\Factory\BankAccountFactory;
use App\Application\Model\Factory\UserFactory;
use App\Domain\Data\ValueObject\BankId;
use App\Domain\Data\ValueObject\UserId;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class BankAccountFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        BankAccountFactory::createSequence([
            [
                'bankId' => BankId::fromString(BankFixtures::CAISSE_EPARGNE),
                'userId' => UserId::fromString(UserFixtures::CLARA),
                'label' => 'Compte courant',
            ],
            [
                'bankId' => BankId::fromString(BankFixtures::CREDIT_FONCIER),
                'userId' => UserId::fromString(UserFixtures::DONNA),
                'label' => 'Compte courant',
            ],
        ]);
    }
}
