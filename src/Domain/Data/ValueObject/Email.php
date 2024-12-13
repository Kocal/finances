<?php

declare(strict_types=1);

namespace App\Domain\Data\ValueObject;

use App\Domain\Exception;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\NoRFCWarningsValidation;
use Finances\Lib\Assert;
use function Symfony\Component\String\s;

final readonly class Email
{
    public const MAX_LENGTH = 150;

    /**
     * @var non-empty-string
     */
    private string $email;

    public function __construct(
        string $email,
        bool $validate = true
    ) {
        $email = self::canonicalize($email);
        $isValid = self::isValid($email);

        if ($validate && ! $isValid) {
            throw new Exception\Email\InvalidEmailFormatException($email);
        }

        if (! $isValid) {
            trigger_error(sprintf('Invalid email detected: "%s".', $email), \E_USER_WARNING);
        }

        $this->email = $email;
    }

    /**
     * @phpstan-assert-if-true non-empty-string $email
     */
    public static function isValid(string $email): bool
    {
        try {
            Assert::notEmpty($email);
            Assert::maxLength($email, self::MAX_LENGTH);
        } catch (\InvalidArgumentException) {
            return false;
        }

        return (new EmailValidator())->isValid($email, new NoRFCWarningsValidation());
    }

    public function equals(self $email): bool
    {
        return $this->email === $email->email;
    }

    /**
     * @return non-empty-string
     */
    public function toString(): string
    {
        return $this->email;
    }

    private static function canonicalize(string $email): string
    {
        return s($email)->trim()->lower()->toString();
    }
}
