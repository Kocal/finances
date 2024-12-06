<?php
declare(strict_types=1);

namespace App\Infrastructure\Database\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Exception\SerializationFailed;
use Doctrine\DBAL\Types\Exception\ValueNotConvertible;
use Doctrine\DBAL\Types\JsonType;
use JsonException;
use Money\Currency;
use Money\Money;

final class MoneyType extends JsonType
{
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        try {
            return json_encode($value, JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION);
        } catch (JsonException $e) {
            throw SerializationFailed::new($value, 'json', $e->getMessage(), $e);
        }
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_resource($value)) {
            $value = stream_get_contents($value);
        }

        try {
            $data = json_decode($value, true, 512, JSON_THROW_ON_ERROR);

            return new Money($data['amount'], new Currency($data['currency']));
        } catch (JsonException $e) {
            throw ValueNotConvertible::new($value, 'json', $e->getMessage(), $e);
        }
    }
}
