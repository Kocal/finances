<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Doctrine\DBAL\Types;

use App\Domain\Data\ValueObject\BankAccountId;

final class BankAccountIdType extends AbstractUuidType
{
    public const string NAME = 'bank_account_id';

    #[\Override]
    public function getName(): string
    {
        return self::NAME;
    }

    #[\Override]
    protected function getIdClass(): string
    {
        return BankAccountId::class;
    }
}
