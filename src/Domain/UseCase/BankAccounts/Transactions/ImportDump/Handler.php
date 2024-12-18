<?php

declare(strict_types=1);

namespace App\Domain\UseCase\BankAccounts\Transactions\ImportDump;

use App\Domain\BankTransactions;
use App\Domain\Data\Repository\BankAccountRepository;
use App\Domain\Exception\BankAccountNotFoundException;
use App\Domain\Exception\DumpParsingException;

final readonly class Handler
{
    public function __construct(
        private BankTransactions\DumpParsing\Parser $bankTransactionsDumpParser,
        private BankAccountRepository $bankAccountRepository,
        private BankTransactions\ParsedTransactionsImporter $parsedTransactionsImporter,
    ) {
    }

    /**
     * @throws DumpParsingException
     * @throws BankAccountNotFoundException
     */
    public function __invoke(Input $input): Output
    {
        $bankAccount = $this->bankAccountRepository->get($input->bankAccountId);

        $parsedBankTransactions = $this->bankTransactionsDumpParser->parse(
            $bankAccount,
            $input->dump,
        );

        $importStats = $this->parsedTransactionsImporter->import(
            $input->bankAccountId,
            $parsedBankTransactions,
        );

        return new Output(
            parsedBankTransactions: $parsedBankTransactions,
            imported: $importStats['imported'],
            skipped: $importStats['skipped'],
        );
    }
}
