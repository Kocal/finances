<?php
declare(strict_types=1);

namespace App\Domain\UseCase\BankTransactions\ParseAndImportDump;

use App\Domain\Data\ValueObject\BankId;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final readonly class Input
{
    public function __construct(
        public BankId $bankId,
        public UploadedFile $dump,
    ) {
    }
}
