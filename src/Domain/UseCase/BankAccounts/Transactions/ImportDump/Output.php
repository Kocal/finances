<?php

declare(strict_types=1);

namespace App\Domain\UseCase\BankAccounts\Transactions\ImportDump;

use App\Domain\Data\Model\ParsedBankTransaction;

final readonly class Output
{
    /**
     * @param array<ParsedBankTransaction> $parsedBankTransactions
     */
    public function __construct(
        public array $parsedBankTransactions,
        public int $imported,
        public int $skipped,
    ) {
    }
}
