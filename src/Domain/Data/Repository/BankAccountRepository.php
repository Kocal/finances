<?php
declare(strict_types=1);

namespace App\Domain\Data\Repository;

use App\Domain\Data\Model\Bank;
use App\Domain\Data\Model\BankAccount;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Exception\BankAccountNotFoundException;

interface BankAccountRepository
{
    /**
     * @throws BankAccountNotFoundException
     */
    public function get(BankAccountId $bankAccountId);

    public function save(Bank $bank): void;
}
