<?php

declare(strict_types=1);

namespace App\Domain\UseCase\BankAccounts\Create;

use App\Domain\Data\Model\BankAccount;

final readonly class Output
{
    public function __construct(
        public BankAccount $bankAccount,
    ) {
    }
}
