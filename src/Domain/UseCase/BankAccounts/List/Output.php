<?php

declare(strict_types=1);

namespace App\Domain\UseCase\BankAccounts\List;

use App\Domain\Data\Model\BankAccount;

final readonly class Output
{
    /**
     * @param array<BankAccount> $bankAccounts
     */
    public function __construct(
        public array $bankAccounts,
    ) {
    }
}
