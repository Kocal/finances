<?php

declare(strict_types=1);

namespace App\Application\Model\DataFixtures;

use App\Application\Model\Factory\UserFactory;
use App\Domain\Data\ValueObject\UserId;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class UserFixtures extends Fixture
{
    public const ADMIN = '0193a003-577b-7cd8-a278-3fe18c604019';

    public const ROSE = '0193a003-577b-7f07-9b05-befab48c7efe';

    public const DONNA = '0193a003-577b-78a0-945a-c8af604bdd99';

    public const CLARA = '0193a003-577b-7cc0-aaf0-f2a55df89f5a';

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

        UserFactory::new()
            ->admin()
            ->create([
                'id' => UserId::fromString(self::ADMIN),
                'username' => 'admin',
            ]);

        UserFactory::createSequence([
            [
                'id' => UserId::fromString(self::ROSE),
                'username' => 'rose',
            ],
            [
                'id' => UserId::fromString(self::DONNA),
                'username' => 'donna',
            ],
            [
                'id' => UserId::fromString(self::CLARA),
                'username' => 'clara',
            ],
        ]);
    }
}
