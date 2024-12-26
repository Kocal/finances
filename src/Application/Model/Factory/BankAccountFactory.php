<?php

declare(strict_types=1);

namespace App\Application\Model\Factory;

use App\Domain\Data\Model\BankAccount;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankId;
use App\Domain\Data\ValueObject\UserId;
use Zenstruck\Foundry\Object\Instantiator;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<BankAccount>
 */
final class BankAccountFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return BankAccount::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'id' => BankAccountId::generate(),
            'userId' => UserId::generate(),
            'bankId' => BankId::random(),
            'label' => self::faker()->text(),
        ];
    }

    protected function initialize(): static
    {
        return $this
            ->instantiateWith(Instantiator::namedConstructor('create'))
        ;
    }
}
