<?php

declare(strict_types=1);

namespace App\Domain\UseCase\User\Create;

use App\Application\CQRS\Command;
use App\Domain\Data\ValueObject\Email;

final readonly class Input implements Command
{
    public function __construct(
        public Email $email,
        public string $plainPassword,
        public bool $admin,
    ) {
    }
}
