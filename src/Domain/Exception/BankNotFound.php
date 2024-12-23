<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\Data\ValueObject\BankId;

final class BankNotFound extends DomainException
{
    public static function byId(BankId $bankId): self
    {
        return new self(sprintf('Bank not found by id "%s".', $bankId->toString()));
    }
}
