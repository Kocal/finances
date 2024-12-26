<?php

declare(strict_types=1);

namespace App\Domain\Data\Repository;

use App\Domain\Data\Model\BankTransaction;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankTransaction\Category;
use App\Domain\Data\ValueObject\BankTransaction\Type;
use Money\Money;

interface BankTransactionRepository
{
    /**
     * @return array<BankTransaction>
     */
    public function findByBankAccount(BankAccountId $bankAccountId, string|null $year, string|null $month): array;

    /**
     * @param 'category'|'type'|null $group
     * @return ($group is 'category' ? array<value-of<Category>, Money> : ($group is 'type' ? array<value-of<Type>, Money> : Money|null))
     */
    public function sumExpenses(
        BankAccountId $bankAccountId,
        string|null $year,
        string|null $month,
        string|null $group = null
    ): array|Money|null;

    public function hasEquivalent(BankTransaction $bankTransaction): bool;

    public function save(BankTransaction $bankTransaction): void;
}
