<?php

declare(strict_types=1);

namespace App\Application\Model\DataFixtures;

use App\Application\Model\Factory\BankAccountFactory;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankId;
use App\Domain\Data\ValueObject\UserId;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class BankAccountFixtures extends Fixture
{
    public const CAISSE_EPARGNE_CLARA = '0193a7d5-ac83-749d-b8a9-e8e305b4344d';

    public const LA_BANQUE_POSTALE_DONNA = '0193a7d5-ac83-7360-8c30-e64a169b1fcc';

    public function __construct(
        #[Autowire(param: 'kernel.environment')]
        private string $appEnv,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        if ($this->appEnv !== 'test') {
            return;
        }

        BankAccountFactory::createSequence([
            [
                'id' => BankAccountId::fromString(self::LA_BANQUE_POSTALE_DONNA),
                'bankId' => BankId::LA_BANQUE_POSTALE,
                'userId' => UserId::fromString(UserFixtures::DONNA),
                'label' => 'Compte courant',
            ],
            [
                'id' => BankAccountId::fromString(self::CAISSE_EPARGNE_CLARA),
                'bankId' => BankId::CAISSE_EPARGNE,
                'userId' => UserId::fromString(UserFixtures::CLARA),
                'label' => 'Compte courant',
            ],
        ]);
    }
}
