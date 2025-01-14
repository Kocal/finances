<?php

declare(strict_types=1);

namespace App\Domain\UseCase\BankAccounts\Transactions\ImportDump;

use App\Application\CQRS\Command;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankTransaction\UserDump;

final readonly class Input implements Command
{
    public function __construct(
        public BankAccountId $bankAccountId,
        public UserDump $dump,
    ) {
    }
}
