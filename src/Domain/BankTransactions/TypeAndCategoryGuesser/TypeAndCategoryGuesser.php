<?php

declare(strict_types=1);

namespace App\Domain\BankTransactions\TypeAndCategoryGuesser;

use App\Domain\BankTransactions\TypeAndCategoryGuesser\Strategy\Strategy;
use App\Domain\Data\ValueObject\BankTransactionCategory;
use App\Domain\Data\ValueObject\BankTransactionType;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final readonly class TypeAndCategoryGuesser
{
    /**
     * @param iterable<Strategy> $strategies
     */
    public function __construct(
        #[AutowireIterator(Strategy::class)]
        private iterable $strategies,
    ) {
    }

    /**
     * @return array{BankTransactionType, BankTransactionCategory}
     */
    public function guess(string $label): array
    {
        foreach ($this->strategies as $strategy) {
            $result = $strategy->guess($label);
            if ($result !== null) {
                return $result;
            }
        }

        return [BankTransactionType::Unknown, BankTransactionCategory::Unknown];
    }
}
