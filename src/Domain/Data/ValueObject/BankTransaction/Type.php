<?php

declare(strict_types=1);

namespace App\Domain\Data\ValueObject\BankTransaction;

use Symfony\Component\Translation\TranslatableMessage;

enum Type: string
{
    case Unknown = 'unknown';

    case Essential = 'essential';
    case Pleasure = 'pleasure';
    case Saving = 'saving';
    case Extra = 'extra';

    /**
     * @var array<key-of<self>, array{ color: string }>
     */
    private const array CONFIGURATION = [
        self::Unknown->name => [
            'color' => 'var(--Type-Unknown-Color)',
        ],
        self::Essential->name => [
            'color' => 'var(--Type-Essential-Color)',
        ],
        self::Pleasure->name => [
            'color' => 'var(--Type-Pleasure-Color)',
        ],
        self::Saving->name => [
            'color' => 'var(--Type-Saving-Color)',
        ],
        self::Extra->name => [
            'color' => 'var(--Type-Extra-Color)',
        ],
    ];

    public function toTranslation(): TranslatableMessage
    {
        return new TranslatableMessage('app.enum.bank_transaction_type.' . $this->value);
    }

    public function getColor(): string
    {
        return self::CONFIGURATION[$this->name]['color'];
    }
}
