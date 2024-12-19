<?php

declare(strict_types=1);

namespace App\Domain\Data\Repository;

use App\Domain\Data\Model\BankTransaction;
use App\Domain\Data\ValueObject\BankAccountId;

interface BankTransactionRepository
{
    /**
     * @return array<BankTransaction>
     */
    public function findByBankAccount(BankAccountId $bankAccountId, string|null $year, string|null $month): array;

    public function save(BankTransaction $bankTransaction): void;

    public function hasEquivalent(BankTransaction $bankTransaction): bool;

    /**
     * @return array<\DateTimeImmutable>
     */
    //    public function getMonthlyDateIntervals(BankAccountId $bankAccountId): array;
}
