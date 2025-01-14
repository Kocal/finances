<?php

declare(strict_types=1);

namespace App\Domain\Data\ValueObject\BankTransaction;

use App\Domain\Data\EnumTrait;
use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

enum Type: string implements TranslatableInterface
{
    use EnumTrait;

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
            'color' => 'var(--BankTransactionType-Unknown-Color)',
        ],
        self::Essential->name => [
            'color' => 'var(--BankTransactionType-Essential-Color)',
        ],
        self::Pleasure->name => [
            'color' => 'var(--BankTransactionType-Pleasure-Color)',
        ],
        self::Saving->name => [
            'color' => 'var(--BankTransactionType-Saving-Color)',
        ],
        self::Extra->name => [
            'color' => 'var(--BankTransactionType-Extra-Color)',
        ],
    ];

    public function getColor(): string
    {
        return self::CONFIGURATION[$this->name]['color'];
    }

    public function trans(TranslatorInterface $translator, ?string $locale = null): string
    {
        return $translator->trans('app.enum.bank_transaction_type.' . $this->value, locale: $locale);
    }
}
