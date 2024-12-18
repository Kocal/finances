<?php

declare(strict_types=1);

namespace App\Domain\Data\Model;

use Money\Money;

final readonly class ParsedBankTransaction
{
    public string $label;

    public function __construct(
        public \DateTimeImmutable $date,
        string $label,
        public Money $amount,
    ) {
        $this->label = trim($label);
    }
}
