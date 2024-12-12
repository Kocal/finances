<?php

declare(strict_types=1);

namespace App\Domain\Data\Repository;

use App\Domain\Data\Model\User;

interface UserRepository
{
    public function findOneByUserIdentifier(string $userIdentifier): ?User;

    public function save(User $user): void;
}
