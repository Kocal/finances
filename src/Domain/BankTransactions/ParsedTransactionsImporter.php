<?php

declare(strict_types=1);

namespace App\Domain\BankTransactions;

use App\Domain\Data\Model\BankTransaction;
use App\Domain\Data\Model\ParsedBankTransaction;
use App\Domain\Data\Repository\BankTransactionRepository;
use App\Domain\Data\ValueObject\BankAccountId;

final readonly class ParsedTransactionsImporter
{
    public function __construct(
        private BankTransactionRepository $bankTransactionRepository,
    ) {
    }

    /**
     * @param array<ParsedBankTransaction> $parsedTransactions
     * @return array{imported: int, skipped: int}
     */
    public function import(BankAccountId $bankAccountId, array $parsedTransactions): array
    {
        $stats = [
            'imported' => 0,
            'skipped' => 0,
        ];

        foreach ($parsedTransactions as $parsedTransaction) {
            [$type, $category] = TypeAndCategoryGuesser::guess($parsedTransaction->label);
            $bankTransaction = BankTransaction::create(
                $bankAccountId,
                $parsedTransaction->amount,
                $parsedTransaction->label,
                $parsedTransaction->date,
                $type,
                $category,
            );

            if (! $this->bankTransactionRepository->hasEquivalent($bankTransaction)) {
                $this->bankTransactionRepository->save($bankTransaction);
                ++$stats['imported'];
            } else {
                ++$stats['skipped'];
            }
        }

        return $stats;
    }
}
