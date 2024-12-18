<?php

declare(strict_types=1);

namespace App\Domain\UseCase\BankAccounts\Create;

use App\Application\CQRS\Command;
use App\Domain\Data\ValueObject\BankId;
use App\Domain\Data\ValueObject\UserId;

final readonly class Input implements Command
{
    public function __construct(
        public BankId $bankId,
        public string $label,
        public UserId $userId,
    ) {
    }
}
