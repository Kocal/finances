<?php

declare(strict_types=1);

namespace App\Domain\UseCase\User\Create;

use App\Domain\Data\Model\User;

final readonly class Output
{
    public function __construct(
        public User $user,
    ) {
    }
}
