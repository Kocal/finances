<?php

declare(strict_types=1);

namespace App\Domain\Exception\Email;

use App\Domain\Exception\DomainException;

final class InvalidEmailFormatException extends DomainException
{
    public function __construct(string $email)
    {
        parent::__construct(sprintf('Invalid email format: "%s".', $email));
    }
}
