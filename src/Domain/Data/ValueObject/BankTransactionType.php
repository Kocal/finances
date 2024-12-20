<?php

declare(strict_types=1);

namespace App\Domain\Data\ValueObject;

use Symfony\Component\Translation\TranslatableMessage;

enum BankTransactionType: string
{
    case Unknown = 'unknown';

    case Essential = 'essential';
    case Pleasure = 'pleasure';
    case Saving = 'saving';
    case Extra = 'extra';

    public function toTranslation(): TranslatableMessage
    {
        return new TranslatableMessage('app.enum.bank_transaction_type.' . $this->value);
    }
}
