<?php

declare(strict_types=1);

namespace App\Domain\Data;

trait EnumTrait
{
    public static function random(): self
    {
        $cases = self::cases();

        return $cases[array_rand($cases)];
    }
}
