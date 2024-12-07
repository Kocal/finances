<?php
declare(strict_types=1);

namespace App\Domain\Data\ValueObject;

enum MimeType: string
{
    case CSV = 'text/csv';

    public function equals(MimeType $mimeType): bool
    {
        return $this->value === $mimeType->value;
    }
}
