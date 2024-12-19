<?php

declare(strict_types=1);

namespace App\Application\CQRS;

interface QueryBus
{
    /**
     * Handle a query synchronously.
     */
    public function handle(Query $query): mixed;
}
