<?php

declare(strict_types=1);

namespace App\Domain\BankTransactions\TypeAndCategoryGuesser\Strategy;

use App\Domain\Data\ValueObject\BankTransactionCategory;
use App\Domain\Data\ValueObject\BankTransactionType;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag]
interface Strategy
{
    /**
     * @return null|array{BankTransactionType, BankTransactionCategory}
     */
    public function guess(string $label): ?array;
}
