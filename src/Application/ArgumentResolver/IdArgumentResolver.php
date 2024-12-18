<?php

declare(strict_types=1);

namespace App\Application\ArgumentResolver;

use App\Domain\Data\ValueObject\Id;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

final readonly class IdArgumentResolver implements ValueResolverInterface
{
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $argumentType = $argument->getType();

        if (! is_subclass_of($argumentType ?? '', Id::class)) {
            return [];
        }

        $value = $request->attributes->get($argument->getName());
        if (! \is_string($value)) {
            return [];
        }

        /** @var class-string<Id> $argumentType */

        try {
            return [$argumentType::fromString($value)];
        } catch (\ValueError) {
            throw new AccessDeniedHttpException();
        }
    }
}
