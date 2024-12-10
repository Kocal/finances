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
    public function findByBankAccount(BankAccountId $bankAccountId): array;

    public function save(BankTransaction $bankTransaction): void;
}
