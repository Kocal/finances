<?php

declare(strict_types=1);

namespace App\Application\ArgumentResolver;

use App\Domain\Data\ValueObject\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class UuidArgumentResolver implements ValueResolverInterface
{
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $argumentType = $argument->getType();

        if (! is_subclass_of($argumentType ?? '', Uuid::class)) {
            return [];
        }

        $value = $request->attributes->get($argument->getName());
        if (! \is_string($value)) {
            return [];
        }

        /** @var class-string<Uuid> $argumentType */

        try {
            return [$argumentType::fromString($value)];
        } catch (\InvalidArgumentException $e) {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }
    }
}
