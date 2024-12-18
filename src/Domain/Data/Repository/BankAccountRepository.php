<?php

declare(strict_types=1);

namespace App\Domain\Data\Repository;

use App\Domain\Data\Model\BankAccount;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\UserId;
use App\Domain\Exception\BankAccountNotFoundException;

interface BankAccountRepository
{
    /**
     * @throws BankAccountNotFoundException
     */
    public function get(BankAccountId $bankAccountId): BankAccount;

    /**
     * @return array<BankAccount>
     */
    public function findByUserId(UserId $userId): array;

    public function save(BankAccount $bank): void;
}
