<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Application\CQRS\Query;
use App\Application\CQRS\QueryBus;

final class SymfonyMessengerQueryBus implements QueryBus
{
    public function __construct(
        private NonTransactionalBus $nonTransactionalBus
    ) {
    }

    public function handle(Query $query): mixed
    {
        return $this->nonTransactionalBus->handle($query);
    }
}
