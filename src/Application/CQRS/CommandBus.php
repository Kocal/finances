<?php

declare(strict_types=1);

namespace App\Application\CQRS;

interface CommandBus
{
    /**
     * Handle a command synchronously.
     */
    public function handle(Command $command): mixed;
}
