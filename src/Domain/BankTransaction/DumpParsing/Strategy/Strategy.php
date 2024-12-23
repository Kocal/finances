<?php

declare(strict_types=1);

namespace App\Domain\BankTransaction\DumpParsing\Strategy;

use App\Domain\Data\Model\ParsedBankTransaction;
use App\Domain\Data\ValueObject\BankId;
use App\Domain\Data\ValueObject\BankTransaction\UserDump;
use App\Domain\Exception\DumpParsingException;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag]
interface Strategy
{
    public function supports(BankId $bankId, UserDump $dump): bool;

    /**
     * @throws DumpParsingException
     * @return array<ParsedBankTransaction>
     */
    public function parse(UserDump $dump): array;
}
