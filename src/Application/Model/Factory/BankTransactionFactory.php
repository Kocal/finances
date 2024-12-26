<?php

declare(strict_types=1);

namespace App\Application\Model\Factory;

use App\Domain\Data\Model\BankTransaction;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankTransaction\Category;
use App\Domain\Data\ValueObject\BankTransaction\Type;
use Money\Money;
use Zenstruck\Foundry\Object\Instantiator;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<BankTransaction>
 */
final class BankTransactionFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return BankTransaction::class;
    }

    protected function defaults(): array
    {
        return [
            'bankAccountId' => BankAccountId::generate(),
            'amount' => Money::EUR(self::faker()->numberBetween(-200, -5000_00)),
            'label' => self::faker()->sentence(5),
            'date' => \DateTimeImmutable::createFromMutable(self::faker()->dateTimeThisMonth()),
            'type' => Type::random(),
            'category' => Category::random(),
        ];
    }

    protected function initialize(): static
    {
        return $this->instantiateWith(Instantiator::namedConstructor('create'));
    }
}
