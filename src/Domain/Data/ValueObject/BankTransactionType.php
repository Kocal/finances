<?php
declare(strict_types=1);

namespace App\Domain\Data\ValueObject;

enum BankTransactionType: string
{
    case DEBIT = 'debit';
    case CREDIT = 'credit';
    case TRANSFER = 'transfer';
    case UNKNOWN = 'unknown';
}
