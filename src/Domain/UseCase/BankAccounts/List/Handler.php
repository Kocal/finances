<?php

declare(strict_types=1);

namespace App\Domain\UseCase\BankAccounts\List;

use App\Domain\Data\Repository\BankAccountRepository;

final readonly class Handler
{
    public function __construct(
        private BankAccountRepository $bankAccountRepository,
    ) {
    }

    public function __invoke(Input $input): Output
    {
        $bankAccounts = $this->bankAccountRepository->findByUserId($input->userId);

        return new Output(
            bankAccounts: $bankAccounts,
        );
    }
}
