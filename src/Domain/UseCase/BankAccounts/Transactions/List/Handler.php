<?php

declare(strict_types=1);

namespace App\Domain\UseCase\BankAccounts\Transactions\List;

use App\Domain\Data\Repository\BankTransactionRepository;

final readonly class Handler
{
    public function __construct(
        private BankTransactionRepository $bankTransactionRepository,
    ) {
    }

    public function __invoke(Input $input): Output
    {
        $transactions = $this->bankTransactionRepository->findByBankAccount(
            bankAccountId: $input->bankAccountId,
            year: $input->year,
            month: $input->month,
        );

        return new Output(
            transactions: $transactions,
        );
    }
}
