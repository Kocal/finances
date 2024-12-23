<?php

declare(strict_types=1);

namespace App\Domain\BankTransaction\TypeAndCategoryGuesser\Strategy;

use App\Domain\Data\ValueObject\BankTransaction\Category;
use App\Domain\Data\ValueObject\BankTransaction\Type;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag]
interface Strategy
{
    /**
     * @return null|array{Type, Category}
     */
    public function guess(string $label): ?array;
}
