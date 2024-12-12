<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Doctrine\DBAL\Types;

use App\Domain\Data\ValueObject\Email;
use App\Domain\Exception\Email\InvalidEmailFormatException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Exception\InvalidType;
use Doctrine\DBAL\Types\Exception\ValueNotConvertible;
use Doctrine\DBAL\Types\Type;

final class EmailType extends Type
{
    public const NAME = 'email';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getClobTypeDeclarationSQL($column);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if ($value === null) {
            return null;
        }

        if (! \is_string($value)) {
            throw InvalidType::new($value, $this->getName(), ['null', 'string', Email::class]);
        }

        try {
            return (new Email($value, false))->toString();
        } catch (\InvalidArgumentException $invalidArgumentException) {
            throw ValueNotConvertible::new($value, $this->getName(), null, $invalidArgumentException);
        }
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Email
    {
        if ($value === null) {
            return null;
        }

        try {
            return new Email($value, false); // Email that comes from database may be invalid so validation should be disabled when hydrating back from database
        } catch (InvalidEmailFormatException $e) {
            throw ValueNotConvertible::new($value, $this->getName(), null, $e);
        }
    }
}
