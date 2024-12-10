<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\Data\ValueObject\BankId;
use App\Domain\Data\ValueObject\MimeType;

final class DumpParsingException extends DomainException
{
    public static function unableToGuessCurrency(): self
    {
        return new self('Unable to guess currency from the dump.');
    }

    public static function unsupportedCurrency(string $currency): self
    {
        return new self(\sprintf('Unsupported currency "%s".', $currency));
    }

    public static function unsupportedDumpForBankAndType(BankId $getBankId, MimeType $mimeType): self
    {
        return new self(\sprintf('Unsupported dump for bank "%s" and type "%s".', $getBankId->toString(), $mimeType->toString()));
    }

    public static function unableToParseDate(mixed $int, string $dateFormat): self
    {
        return new self(\sprintf('Unable to parse date "%s" when using format "%s".', $int, $dateFormat));
    }
}
