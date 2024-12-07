<?php
declare(strict_types=1);

namespace App\Domain\Data\Repository;

use App\Domain\Data\Model\Bank;
use App\Domain\Data\Model\BankAccount;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankId;
use App\Domain\Exception\BankNotFound;

interface BankRepository
{
    /**
     * @throws BankNotFound
     */
    public function get(BankId $bankId): Bank;

    public function save(Bank $bank): void;
}
