<?php
declare(strict_types=1);

namespace App\Domain\Data\Repository;

use App\Domain\Data\Model\Bank;
use App\Domain\Data\Model\BankAccount;
use App\Domain\Data\ValueObject\BankAccountId;

interface BankAccountRepository
{
    public function save(Bank $bank): void;
}
