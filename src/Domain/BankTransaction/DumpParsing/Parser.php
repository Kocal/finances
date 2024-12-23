<?php

declare(strict_types=1);

namespace App\Domain\BankTransaction\DumpParsing;

use App\Domain\BankTransaction\DumpParsing\Strategy\Strategy;
use App\Domain\Data\Model\BankAccount;
use App\Domain\Data\Model\ParsedBankTransaction;
use App\Domain\Data\ValueObject\BankTransaction\UserDump;
use App\Domain\Exception\DumpParsingException;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final readonly class Parser
{
    /**
     * @param iterable<Strategy> $strategies
     */
    public function __construct(
        #[AutowireIterator(Strategy::class)]
        private iterable $strategies,
    ) {
    }

    /**
     * @return array<ParsedBankTransaction>
     * @throws DumpParsingException
     */
    public function parse(BankAccount $bankAccount, UserDump $dump): array
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($bankAccount->getBankId(), $dump)) {
                return $strategy->parse($dump);
            }
        }

        throw DumpParsingException::unsupportedDumpForBankAndType($bankAccount->getBankId(), $dump->mimeType);
    }
}
