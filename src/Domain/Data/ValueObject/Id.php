<?php

declare(strict_types=1);

namespace App\Domain\Data\ValueObject;

interface Id
{
    public static function fromString(string $id): static;

    public function toString(): string;
}
