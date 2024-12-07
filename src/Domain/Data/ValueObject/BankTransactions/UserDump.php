<?php
declare(strict_types=1);

namespace App\Domain\Data\ValueObject\BankTransactions;

use App\Domain\Data\ValueObject\MimeType;

final readonly class UserDump
{
    public function __construct(
        public string $content,
        public MimeType $mimeType,
    ) {
    }
}
