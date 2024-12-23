<?php

declare(strict_types=1);

namespace App\Domain\BankTransaction\TypeAndCategoryGuesser;

use App\Domain\BankTransaction\TypeAndCategoryGuesser\Strategy\Strategy;
use App\Domain\Data\ValueObject\BankTransaction\Category;
use App\Domain\Data\ValueObject\BankTransaction\Type;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final readonly class TypeAndCategoryGuesser
{
    /**
     * @param iterable<Strategy> $strategies
     */
    public function __construct(
        #[AutowireIterator(Strategy::class)]
        private iterable $strategies,
    ) {
    }

    /**
     * @return array{Type, Category}
     */
    public function guess(string $label): array
    {
        foreach ($this->strategies as $strategy) {
            $result = $strategy->guess($label);
            if ($result !== null) {
                return $result;
            }
        }

        return [Type::Unknown, Category::Unknown];
    }
}
