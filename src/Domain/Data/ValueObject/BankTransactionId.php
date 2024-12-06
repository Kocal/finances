<?php

declare(strict_types=1);

namespace App\Domain\Data\ValueObject;

use App\Domain\Data\UuidTrait;

final class BankTransactionId implements Id
{
    use UuidTrait;
}
