<?php

declare(strict_types=1);

namespace App\Domain\Data\ValueObject\BankTransactions;

use App\Domain\Data\ValueObject\MimeType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final readonly class UserDump
{
    public function __construct(
        public string $content,
        public MimeType $mimeType,
    ) {
    }

    public static function fromUploadedFile(UploadedFile $uploadedFile): self
    {
        return new self(
            $uploadedFile->getContent(),
            MimeType::fromString($uploadedFile->getMimeType() ?? $uploadedFile->getClientMimeType()),
        );
    }
}
