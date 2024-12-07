<?php
declare(strict_types=1);

namespace App\Domain\BankTransactions\DumpParsing\Strategy\LaBanquePostale;

use App\Domain\BankTransactions\DumpParsing\Strategy\Strategy;
use App\Domain\Data\Model\Bank;
use App\Domain\Data\Model\BankAccount;
use App\Domain\Data\ValueObject\BankTransactions\UserDump;
use App\Domain\Data\ValueObject\MimeType;

final readonly class CsvStrategy implements Strategy
{
    public function supports(Bank $bank, UserDump $dump): bool
    {
        return $dump->mimeType->equals(MimeType::CSV) /*  && la banque postale */;
    }

    public function parse(Bank $bank, BankAccount $bankAccount, UserDump $dump): iterable
    {
        // TODO: Implement parse() method.
    }
}
