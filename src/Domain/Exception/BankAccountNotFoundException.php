<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\Data\ValueObject\BankAccountId;

final class BankAccountNotFoundException extends DomainException
{
    public static function byId(BankAccountId $bankAccountId): self
    {
        return new self(sprintf('Bank account not found by id "%s".', $bankAccountId->toString()));
    }
}
