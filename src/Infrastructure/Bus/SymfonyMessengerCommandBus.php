<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Application\CQRS\Command;
use App\Application\CQRS\CommandBus;

final class SymfonyMessengerCommandBus implements CommandBus
{
    public function __construct(
        private TransactionalBus $transactionalBus
    ) {
    }

    public function handle(Command $command): mixed
    {
        return $this->transactionalBus->handle($command);
    }
}
