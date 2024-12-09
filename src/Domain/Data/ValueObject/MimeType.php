<?php
declare(strict_types=1);

namespace App\Domain\Data\ValueObject;

use function Symfony\Component\String\s;

class MimeType
{
    private string $value;

    public static function fromString(string $value): self
    {
        return new self(s($value)->lower()->trim()->toString());
    }

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function isCsv(): bool
    {
        return in_array($this->value, [
            'text/csv',
        ], true);
    }
}
