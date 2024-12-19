<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\UX\LiveComponent\Hydration;

use App\Domain\Data\ValueObject\Uuid;
use Symfony\UX\LiveComponent\Hydration\HydrationExtensionInterface;

final readonly class UuidValueObjectHydrationExtension implements HydrationExtensionInterface
{
    public function supports(string $className): bool
    {
        return is_subclass_of($className, Uuid::class);
    }

    public function hydrate(mixed $value, string $className): ?object
    {
        return $className::fromString($value);
    }

    public function dehydrate(object $object): mixed
    {
        return $object->toString();
    }
}
