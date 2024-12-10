<?php

declare(strict_types=1);

namespace App\Application\Model\Factory;

use App\Domain\Data\Model\Bank;
use Zenstruck\Foundry\Object\Instantiator;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Bank>
 */
final class BankFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Bank::class;
    }

    protected function defaults(): array|callable
    {
        return [];
    }

    protected function initialize(): static
    {
        return $this
            ->instantiateWith(Instantiator::namedConstructor('create'))
        ;
    }
}
