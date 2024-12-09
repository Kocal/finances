<?php
declare(strict_types=1);

namespace App\Domain\UseCase\BankTransactions\ParseDump;

use App\Application\CQRS\Command;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankTransactions\UserDump;

final readonly class Input implements Command
{
    public function __construct(
        public BankAccountId $bankAccountId,
        public UserDump $dump,
    ) {
    }
}
