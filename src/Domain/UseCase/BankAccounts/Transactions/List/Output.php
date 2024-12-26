<?php

declare(strict_types=1);

namespace App\Domain\UseCase\BankAccounts\Transactions\List;

use App\Domain\Data\Model\BankTransaction;
use App\Domain\Data\ValueObject\BankTransaction\Category;
use App\Domain\Data\ValueObject\BankTransaction\Type;
use Money\Money;

final readonly class Output
{
    /**
     * @param array<BankTransaction> $transactions
     * @param array<value-of<Type>, Money> $amountByType
     * @param array<value-of<Category>, Money> $amountByCategory
     */
    public function __construct(
        public array $transactions,
        public ?Money $totalAmount,
        public array $amountByType,
        public array $amountByCategory,
    ) {
    }
}
