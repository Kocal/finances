<?php

declare(strict_types=1);

namespace App\Application\Twig\Components;

use App\Domain\Data\ValueObject\BankTransactionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
final class BankTransactionTypeBadge
{
    public BankTransactionType $type;

    /**
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    #[PreMount]
    public function preMount(array $data): array
    {
        $optionsResolver = new OptionsResolver();
        $optionsResolver->setIgnoreUndefined(true);
        $optionsResolver->define('type')->required()->allowedTypes(BankTransactionType::class);

        return $optionsResolver->resolve($data) + $data;
    }
}
