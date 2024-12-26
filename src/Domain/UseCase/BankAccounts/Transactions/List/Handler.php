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

        $totalAmount = $this->bankTransactionRepository->sumExpenses(
            bankAccountId: $input->bankAccountId,
            year: $input->year,
            month: $input->month,
        );

        $amountByType = $this->bankTransactionRepository->sumExpenses(
            bankAccountId: $input->bankAccountId,
            year: $input->year,
            month: $input->month,
            group: 'type',
        );

        $amountByCategory = $this->bankTransactionRepository->sumExpenses(
            bankAccountId: $input->bankAccountId,
            year: $input->year,
            month: $input->month,
            group: 'category',
        );

        return new Output(
            transactions: $transactions,
            totalAmount: $totalAmount,
            amountByType: $amountByType,
            amountByCategory: $amountByCategory,
        );
    }
}
