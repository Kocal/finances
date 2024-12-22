<?php

declare(strict_types=1);

namespace App\Application\Twig\Components;

use App\Domain\Data\ValueObject\BankTransactionCategory;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
final class BankTransactionCategoryAvatar
{
    public BankTransactionCategory $category;

    /**
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    #[PreMount]
    public function preMount(array $data): array
    {
        $optionsResolver = new OptionsResolver();
        $optionsResolver->setIgnoreUndefined(true);
        $optionsResolver->define('category')->required()->allowedTypes(BankTransactionCategory::class);

        return $optionsResolver->resolve($data) + $data;
    }
}
