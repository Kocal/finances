<?php

declare(strict_types=1);

namespace App\Domain\UseCase\BankAccounts\Transactions\List;

use App\Application\CQRS\Query;
use App\Domain\Data\ValueObject\BankAccountId;

final readonly class Input implements Query
{
    public function __construct(
        public BankAccountId $bankAccountId,
        public string $year,
        public string $month,
    ) {
    }
}
