<?php

declare(strict_types=1);

namespace App\Application\CQRS;

interface CommandBus
{
    public function handle(object $command): mixed;
}
