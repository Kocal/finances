<?php

declare(strict_types=1);

namespace App\Domain\UseCase\BankAccounts\Transactions\List;

use App\Domain\Data\Model\BankTransaction;

final readonly class Output
{
    /**
     * @param array<BankTransaction> $transactions
     */
    public function __construct(
        public array $transactions = [],
    ) {
    }
}
