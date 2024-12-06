<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Doctrine\DBAL\Types;

use App\Domain\Data\ValueObject\BankTransactionId;

final class BankTransactionIdType extends AbstractIdType
{
    public const string NAME = 'bank_transaction_id';

    #[\Override]
    public function getName(): string
    {
        return self::NAME;
    }

    #[\Override]
    protected function getIdClass(): string
    {
        return BankTransactionId::class;
    }
}
