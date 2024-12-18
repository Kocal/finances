<?php

declare(strict_types=1);

namespace App\Domain\UseCase\BankAccounts\Create;

use App\Domain\Data\Model\BankAccount;
use App\Domain\Data\Repository\BankAccountRepository;
use App\Domain\Data\ValueObject\BankAccountId;

final readonly class Handler
{
    public function __construct(
        private BankAccountRepository $bankAccountRepository,
    ) {
    }

    public function __invoke(Input $input): Output
    {
        $bankAccount = BankAccount::create(
            BankAccountId::generate(),
            $input->userId,
            $input->bankId,
            $input->label,
        );

        $this->bankAccountRepository->save($bankAccount);

        return new Output(
            bankAccount: $bankAccount,
        );
    }
}
