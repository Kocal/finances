<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Doctrine\DBAL\Types;

use App\Domain\Data\ValueObject\BankId;

final class BankIdType extends AbstractIdType
{
    public const string NAME = 'bank_id';

    #[\Override]
    public function getName(): string
    {
        return self::NAME;
    }

    #[\Override]
    protected function getIdClass(): string
    {
        return BankId::class;
    }
}
