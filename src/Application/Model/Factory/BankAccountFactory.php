<?php

namespace App\Application\Model\Factory;

use App\Domain\Data\Model\BankAccount;
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
