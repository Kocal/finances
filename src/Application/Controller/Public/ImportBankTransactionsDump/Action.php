<?php

declare(strict_types=1);

namespace App\Application\Controller\Public\ImportBankTransactionsDump;

use App\Application\CQRS\CommandBus;
use App\Domain\Data\ValueObject\BankId;
use App\Domain\Data\ValueObject\BankTransactions\UserDump;
use App\Domain\UseCase\BankTransactions\ParseDump;
use Symfony\Component\HttpFoundation\Response;

final readonly class Action
{
    public function __construct(
        private CommandBus $commandBus,
    ) {
    }

    public function __invoke(): Response
    {
        try {
            //$output = $this->commandBus->handle(new ParseDump\Input(
            //    bankAccountId: BankId::LA_BANQUE_POSTALE, // TODO: get it from request
            //    dump: UserDump::fromUploadedFile($file),
            //));
        } catch (\Throwable $e) {

        }

        return new Response();
    }
}
