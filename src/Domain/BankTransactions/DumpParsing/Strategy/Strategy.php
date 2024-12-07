<?php
declare(strict_types=1);

namespace App\Domain\BankTransactions\DumpParsing\Strategy;

use App\Domain\Data\Model\Bank;
use App\Domain\Data\Model\BankAccount;
use App\Domain\Data\Model\BankTransaction;
use App\Domain\Data\ValueObject\BankTransactions\UserDump;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag]
interface Strategy
{
    public function supports(Bank $bank, UserDump $dump): bool;

    /**
     * @return iterable<BankTransaction>
     */
    public function parse(Bank $bank, BankAccount $bankAccount, UserDump $dump): iterable;
}
