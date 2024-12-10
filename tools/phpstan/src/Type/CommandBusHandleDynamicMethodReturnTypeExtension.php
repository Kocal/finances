<?php

declare(strict_types=1);

namespace AppTools\PHPStan\Type;

use App\Application\CQRS\CommandBus;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\ObjectType;
use function Symfony\Component\String\s;

final readonly class CommandBusHandleDynamicMethodReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    #[\Override]
    public function getClass(): string
    {
        return CommandBus::class;
    }

    #[\Override]
    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return $methodReflection->getName() === 'handle';
    }

    #[\Override]
    public function getTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, Scope $scope): ?\PHPStan\Type\Type
    {
        $input = $methodCall->getArgs()[0]->value;
        $inputType = $scope->getType($input);

        if (! $inputType->isObject()->yes()) {
            return null;
        }

        $inputClass = s($inputType->getObjectClassNames()[0]);
        if (! $inputClass->endsWith('\Input')) {
            return null;
        }

        $outputClass = $inputClass->beforeLast('Input')->append('Output');

        return new ObjectType($outputClass->toString());
    }
}
